<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\I18n\Time;

class MessagesController extends AppController
{

    public function index(){
        $messagess = $this->Messages->find('all')->count();
        $messages = $this->Messages->find('all');
        $this->set(compact('messages'));;
        $this->set(compact('messagess'));
    }
}