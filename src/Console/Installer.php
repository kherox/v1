<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     3.0.0
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Console;

use Composer\Script\Event;
use Exception;
use \mysqli;

/**
 * Provides installation hooks for when this application is installed via
 * composer. Customize this class to suit your needs.
 */
class Installer
{

    protected static $_hostName = 'localhost';
    protected static $_userName = 'root';
    protected static $_password = '';
    protected static $_databaseName = 'Ticki';
    protected static $_port = false;
    

    /**
     * Does some routine installation tasks so people don't have to.
     *
     * @param \Composer\Script\Event $event The composer event object.
     * @throws \Exception Exception raised by validator.
     * @return void
     */
    public static function postInstall(Event $event)
    {
        $io = $event->getIO();

        $rootDir = dirname(dirname(__DIR__));

        static::createAppConfig($rootDir, $io);
        static::createWritableDirectories($rootDir, $io);
        if(static::setDatabase($rootDir, $io)) {
            static::generateDatabase($rootDir, $io);
        }

        // ask if the permissions should be changed
        if ($io->isInteractive()) {
            $validator = function ($arg) {
                if (in_array($arg, ['Y', 'y', 'N', 'n'])) {
                    return $arg;
                }
                throw new Exception('This is not a valid answer. Please choose Y or n.');
            };
            $setFolderPermissions = $io->askAndValidate(
                '<info>Set Folder Permissions ? (Default to Y)</info> [<comment>Y,n</comment>]? ',
                $validator,
                10,
                'Y'
            );

            if (in_array($setFolderPermissions, ['Y', 'y'])) {
                static::setFolderPermissions($rootDir, $io);
            }
        } else {
            static::setFolderPermissions($rootDir, $io);
        }

        static::setSecuritySalt($rootDir, $io);

        if (class_exists('\Cake\Codeception\Console\Installer')) {
            \Cake\Codeception\Console\Installer::customizeCodeceptionBinary($event);
        }

    }

    /**
     * Create the config/app.php file if it does not exist.
     *
     * @param string $dir The application's root directory.
     * @param \Composer\IO\IOInterface $io IO interface to write to console.
     * @return void
     */
    public static function createAppConfig($dir, $io)
    {
        $appConfig = $dir . '/config/app.php';
        $defaultConfig = $dir . '/config/app.default.php';
        if (!file_exists($appConfig)) {
            copy($defaultConfig, $appConfig);
            $io->write('Created `config/app.php` file');
        }
    }

    /**
     * Create the `logs` and `tmp` directories.
     *
     * @param string $dir The application's root directory.
     * @param \Composer\IO\IOInterface $io IO interface to write to console.
     * @return void
     */
    public static function createWritableDirectories($dir, $io)
    {
        $paths = [
            'logs',
            'tmp',
            'tmp/cache',
            'tmp/cache/models',
            'tmp/cache/persistent',
            'tmp/cache/views',
            'tmp/sessions',
            'tmp/tests'
        ];

        foreach ($paths as $path) {
            $path = $dir . '/' . $path;
            if (!file_exists($path)) {
                mkdir($path);
                $io->write('Created `' . $path . '` directory');
            }
        }
    }

    /**
     * Set globally writable permissions on the "tmp" and "logs" directory.
     *
     * This is not the most secure default, but it gets people up and running quickly.
     *
     * @param string $dir The application's root directory.
     * @param \Composer\IO\IOInterface $io IO interface to write to console.
     * @return void
     */
    public static function setFolderPermissions($dir, $io)
    {
        // Change the permissions on a path and output the results.
        $changePerms = function ($path, $perms, $io) {
            // Get current permissions in decimal format so we can bitmask it.
            $currentPerms = octdec(substr(sprintf('%o', fileperms($path)), -4));
            if (($currentPerms & $perms) == $perms) {
                return;
            }

            $res = chmod($path, $currentPerms | $perms);
            if ($res) {
                $io->write('Permissions set on ' . $path);
            } else {
                $io->write('Failed to set permissions on ' . $path);
            }
        };

        $walker = function ($dir, $perms, $io) use (&$walker, $changePerms) {
            $files = array_diff(scandir($dir), ['.', '..']);
            foreach ($files as $file) {
                $path = $dir . '/' . $file;

                if (!is_dir($path)) {
                    continue;
                }

                $changePerms($path, $perms, $io);
                $walker($path, $perms, $io);
            }
        };

        $worldWritable = bindec('0000000111');
        $walker($dir . '/tmp', $worldWritable, $io);
        $changePerms($dir . '/tmp', $worldWritable, $io);
        $changePerms($dir . '/logs', $worldWritable, $io);
    }

    /**
     * Set the security.salt value in the application's config file.
     *
     * @param string $dir The application's root directory.
     * @param \Composer\IO\IOInterface $io IO interface to write to console.
     * @return void
     */
    public static function setSecuritySalt($dir, $io)
    {
        $config = $dir . '/config/app.php';
        $content = file_get_contents($config);

        $newKey = hash('sha256', $dir . php_uname() . microtime(true));
        $content = str_replace('__SALT__', $newKey, $content, $count);

        if ($count == 0) {
            $io->write('No Security.salt placeholder to replace.');
            return;
        }

        $result = file_put_contents($config, $content);
        if ($result) {
            $io->write('Updated Security.salt value in config/app.php');
            return;
        }
        $io->write('Unable to update Security.salt value.');
    }

    /**
     * setDatabase
     * Set info for database configuration
     * @param string $dir The application's root directory.
     * @param \Composer\IO\IOInterface $io IO interface to write to console.
     * @return boolean
     */
    public static function setDatabase($dir, $io)
    {
        $config = $dir . '/config/app.php';

        $content = file_get_contents($config);

        static::$_databaseName = $databaseName = $io->ask('What is your new database name ? [<comment>Ticki</comment>] ', 'Ticki');

        $content = str_replace('_DATABASENAME_', $databaseName, $content, $count);

        if ($count == 0) {
            $io->write('No Datasources.default.database placeholder to replace.');
            return false;
        }

        $result = file_put_contents($config, $content);
        if (!$result) {
            $io->write('Unable to update Datasources.default.database value.');
            return false;
        }
        $io->write('Updated Datasources.default.database value in config/app.php');

        static::$_hostName = $hostName = $io->ask('What is your database host ip ? [<comment>localhost</comment>] ', 'localhost');

        $content = str_replace('_HOST_', $hostName, $content, $count);

        if ($count == 0) {
            $io->write('No Datasources.default.host placeholder to replace.');
            return false;
        }

        $result = file_put_contents($config, $content);
        if (!$result) {
            $io->write('Unable to update Datasources.default.host value.');
            return false;
        }
        $io->write('Updated Datasources.default.host value in config/app.php');

        static::$_port = $port = $io->ask('What is your database port number ?[<comment>leave empty for no port</comment>] ', '');

        if(empty($port)) {
            $content = str_replace('_PORT_', '', $content);
            static::$_port = false;
        }
        else {
             $content = str_replace('_PORT_', "'port' => ". $port .",", $content);
        }

        $result = file_put_contents($config, $content);
        if (!$result) {
            $io->write('Unable to update Datasources.default.port value.');
            return false;
        }
        $io->write('Updated Datasources.default.port value in config/app.php');

        static::$_userName =$userName = $io->ask('What is your database login ?  [<comment>root</comment>] ', 'root');

        $content = str_replace('_USERNAME_', $userName, $content, $count);

        if ($count == 0) {
            $io->write('No Datasources.default.username placeholder to replace.');
            return false;
        }

        $result = file_put_contents($config, $content);
        if (!$result) {
            $io->write('Unable to update Datasources.default.username value.');
            return false;
        }
        $io->write('Updated Datasources.default.username value in config/app.php');

        static::$_password = $password = $io->ask('What is your database password ? ', '');

        $content = str_replace('_PASSWORD_', $password, $content, $count);

        $result = file_put_contents($config, $content);
        if (!$result) {
            $io->write('Unable to update Datasources.default.password value.');
            return false;
        }
        $io->write('Updated Datasources.default.password value in config/app.php');
        return true;
    }

    /**
     * generateDatabase
     * Execute TickiSql for application
     * @param string $dir The application's root directory.
     * @param \Composer\IO\IOInterface $io IO interface to write to console.
     * @return void
     */
    public static function generateDatabase($rootDir, $io)
    {
        $installDatabase = $io->ask('Install Ticki database automatically ? </info> [<comment>Y,n</comment>]? ', 'Y', 'Y');

        if($installDatabase !== 'N' || $installDatabase !== 'n') {

            $TickiConfig = $rootDir . '/config/schema/Ticki.sql';
            $content = file_get_contents($TickiConfig);

            $content = str_replace('_DATABASE_', static::$_databaseName, $content);

            $result = file_put_contents($TickiConfig, $content);
            if (!$result) {
                $io->write('Unable to update Database value on sql file.');
                return;
            }

            $mysqli = null;
            if(static::$_port) {
                $mysqli = new Mysqli(static::$_hostName, static::$_userName, static::$_password, "", static::$_port);
            } else {
                $mysqli = new Mysqli(static::$_hostName, static::$_userName, static::$_password);
            }

            if ($mysqli->connect_errno) {
                $io->write("<error>Connection fail : " . $mysqli->connect_error .'</error>');
                return;
            }

            if(!$mysqli->multi_query($content)) {
                $io->write('<error>Unable to install database, do it manually please</error>');
            }

            $mysqli->close();
            $io->write('<info>Set up database Ticki is a success.</info>');
        }
    }
}
