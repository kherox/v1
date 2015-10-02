<?php

namespace App\Controller\Admin;

use App\Controller\AppController;

class UsersController extends AppController
{
    public function index(){
        $users = $this->Users->find('all');
        $this->set(compact('users'));
    }

    public function add(){

    }

    public function edit(){

    }

    public function delete(){
        $user = $this->Users
            ->find()
            ->where([
                'Users.id' => $this->request->id
            ])
            ->first();

        $user->is_deleted = true;

        if($this->Users->save($user)){
            $this->Flash->success("Votre compte à bien été supprimer!");
            return $this->redirect($this->Auth->logout());
        }
    }
}