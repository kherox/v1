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
}