<?php
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
                'action'     => 'index',
                'prefix'     => false
            ],

            'unauthorizeRedirect' => [
                'controller' => 'pages',
                'action'     => 'index',
                'prefix'     => false
            ],

            'loginAction' => [
                'controller' => 'users',
                'action'     => 'login',
                'prefix'     => false
            ],

            'logoutRedirect' => [
                'controller' => 'pages',
                'action'     => 'index'
            ]
        ]);
    }

    public function beforeFilter(Event $event)
    {
        // Si il est pas connecté, une erreur arrive.
        $this->Auth->authError = "Vous devez vous connecter pour accéder à cette page.";

        // J'autorise aux utilisateurs non inscrit à accédez à c'est pages.
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
                if($this->request->session()->read('Auth.User.role') == 'admin') {
                    // Je change mon layout, en utilisant Admin
                    $this->viewBuilder()->layout('admin');
                }else{
                    // Je reste sur la même page et j'affiche une erreur
                    $this->redirect($this->referer());
                    $this->Flash->error('Vous ne pouvez pas accédez à cette page');
                }
            }
        }
    }

    public function isAuthorized($user)
    {
        if (isset($user['role']) && $user['role'] === 'admin')
            return true;
        return false;
    }
}
