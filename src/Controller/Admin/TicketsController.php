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

    public function add()
    {
        $user = $this->Auth->user();
        $ticket = $this->Tickets->newEntity();

        if ($this->request->is('post')) {
            $ticket = $this->Tickets->patchEntity($ticket, $this->request->data);
            $ticket->user_id = $user['id'];

            // SAUVEGARDE TICKET
            if ($this->Tickets->save($ticket)) {
                $this->Flash->success(__('Votre ticket à bien était sauvegarder.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Votre ticket n\'a pas plus être sauvegarder, veuillez recommencer.'));
            }
        }

        $this->set('ticket', $ticket);
        $this->set('_serialize', ['ticket']);
    }
}