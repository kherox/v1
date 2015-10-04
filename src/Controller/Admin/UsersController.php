<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\I18n\Time;


class UsersController extends AppController
{

    public function index(){
        $userss = $this->Users->find('all')->count();
        $users = $this->Users->find('all');
        $this->set(compact('users'));
        $this->set(compact('userss'));
    }

    public function add(){
        $this->loadModel('UserModel');

        $user = $this->Users->newEntity($this->request->data);

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);

            if ($this->Users->save($user)) {
                $this->Flash->success(__('Votre compte à bien était créé.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Votre compte n\'a pas plus être créé.'));
            }
        }

        $this->set(compact('user'));
    }
}