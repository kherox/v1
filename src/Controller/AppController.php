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
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;

class AppController extends Controller
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'authError' => 'Vous devez être connecter pour allez sur cette page.',
            'loginRedirect' => [
                'controller' => 'users',
                'action' => 'index',
                'prefix' => false
            ],
            'unauthorizeRedirect' => [
                'controller' => 'pages',
                'action' => 'index',
                'prefix' => false
            ],
            'loginAction' => [
                'controller' => 'users',
                'action' => 'login',
                'prefix' => false
            ],
            'logoutRedirect' => [
                'controller' => 'pages',
                'action' => 'index'
            ]
        ]);
    }

    public function beforeFilter(Event $event)
    {
        $this->Auth->authError = "Vous devez vous connecter pour accéder à cette page.";

        $this->Auth->allow([
            'index',
            'view',
            'display',
            'forgot_password',
            'reset_password'
        ]);

        if(isset($this->request->params['prefix'])){
            $prefix = explode('/', $this->request->params['prefix'])[0];

            if($prefix == 'admin'){
                // Si le role est vide, je rend une erreur
                if(empty($this->request->session()->read('Auth.User.role'))) {
                    //throw new NotFoundException();
                    $this->redirect($this->referer());
                    $this->Flash->error('Vous ne pouvez pas accédez à cette page');
                }else{
                    // Je change mon layout, en utilisant Admin
                    $this->viewBuilder()->layout('admin');
                }
            }
        }
    }

    public function isAuthorized($user)
    {
        // Si mon role et égal à Admin, je return true
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }
        return false;
    }
}
