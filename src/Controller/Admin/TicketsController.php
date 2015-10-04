<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\I18n\Time;

class TicketsController extends AppController
{

    public function index(){
        $ticketss = $this->Tickets->find('all')->count();
        $tickets = $this->Tickets->find('all');
        $this->set(compact('tickets'));;
        $this->set(compact('ticketss'));
    }
}