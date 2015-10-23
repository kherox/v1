<?php
$baseDir = dirname(dirname(__FILE__));
return [
    'plugins' => [
        'Bake' => $baseDir . '/vendor/cakephp/bake/',
        'DebugKit' => $baseDir . '/vendor/cakephp/debug_kit/',
        'Migrations' => $baseDir . '/vendor/cakephp/migrations/',
        'Notifier' => $baseDir . '/vendor/cakemanager/cakephp-notifier/',
        'Recaptcha' => $baseDir . '/vendor/cake17/cakephp-recaptcha/'
    ]
];
