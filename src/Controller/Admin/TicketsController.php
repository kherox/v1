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

    public function add(){
        $this->loadModel('TicketModel');

        $user = $this->Tickets->newEntity($this->request->data);

        if ($this->request->is('post')) {
            $user = $this->Tickets->patchEntity($user, $this->request->data);

            if ($this->Tickets->save($user)) {
                $this->Flash->success(__('Votre compte à bien était créé.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Votre compte n\'a pas plus être créé.'));
            }
        }

        $this->set(compact('Tickets'));
    }
}