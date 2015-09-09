<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;

class TicketsController extends AppController
{

    public $paginate = [
        'limit' => 10,
        'order' => [
            'Tickets.created' => 'asc'
        ]
    ];

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
    }

    public function isAuthorized($user)
    {
        $user = $this->Auth->user();
        if ($this->request->action === 'add') {
            return true;
        }

        if (in_array($this->request->action, ['edit', 'delete'])) {
            $ticketId = (int)$this->request->params['pass'][0];
            if ($this->Tickets->isOwnedBy($ticketId, $user['id'])) {
                return true;
            }

            if($user['role'] == 'admin'){
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    /**
     * Visualisation de tout les tickets pour les admins/modos
     **/
    public function index()
    {
        $this->loadModel('Tickets');

        $u = $this->loadModel('Users');
        $users = $u->find('all');

        $this->paginate = [
            'maxLimit' =>  Configure::read('Paginate.Ticket.indexTickets')
        ];

        $tickets = $this->Tickets
            ->find()
            ->contain(['Comments'])
            ->order(['created' => 'desc']);

        $tickets = $this->paginate($tickets);

        $this->set(compact('tickets'));
        $this->set('users', $users);
        $this->set('_serialize', ['tickets']);
    }

    /**
     * Visualisation de tout les tickets pour les admins/modos
     **/
    public function view($id = null)
    {
        $u = $this->loadModel('Users');
        $users = $u->find('all');
        $user = $this->Auth->user();

        $ticket = $this->Tickets->get($id, [
            'contain' => ['Users', 'Comments']
        ]);

        if ($this->request->is('post')) {
            $this->request->data['ticket_id'] = $id;
            $this->request->data['user_id'] = $user['id'];

            $comment = $this->Tickets->Comments->newEntity();
            $comment = $this->Tickets->Comments->patchEntity($comment, $this->request->data);

            if ($this->Tickets->Comments->save($comment)) {
                $this->Flash->success(__('Votre commentaire à bien était sauvegarder.'));
            } else {
                $this->Flash->error(__('Votre commentaire n\'a pas plus être sauvegarder, veuillez recommencer.'));
            }
            return $this->redirect($this->referer());
        }

        // VARIABLES
        $this->set('ticket', $ticket);
        $this->set('users', $users);
        $this->set('_serialize', ['ticket']);
    }

    /**
     * Ajout d'un ticket
     */

    public function add()
    {
        $user = $this->Auth->user();
        $ticket = $this->Tickets->newEntity($this->request->data);

        if ($this->request->is('post')) {
            $ticket->user_id = $user['id'];
            if ($this->Tickets->save($ticket)) {
                $this->Flash->success(__('Votre ticket à bien était sauvegarder.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Votre ticket n\'a pas plus être sauvegarder, veuillez recommencer.'));
            }
        }


        $this->set(compact('ticket', 'user'));
        $this->set('_serialize', ['ticket']);
    }
    /**
     * Édition du ticket
     */
    public function edit($id = null)
    {
        if($this->request->session()->read('Auth.User.role') == 'admin'){
            $ticket = $this->Tickets->get($id);
        }else{
            $ticket = $this->Tickets->get($id, [
                'conditions' => [
                    'Tickets.user_id' => $this->request->session()->read('Auth.User.id')
                ]
            ]);
        }

        if ($this->request->is(['post', 'put'])) {
            $ticket = $this->Tickets->patchEntity($ticket, $this->request->data);
            if ($this->Tickets->save($ticket)) {
                $this->Flash->success(__('Votre ticket a bien été édité'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Votre ticket n\'a pas pu être édité, veuillez recommencer.'));
            }
        }

        $users = $this->Tickets->Users->find('list', ['limit' => 200]);
        $tags = $this->Tickets->Tags->find('list', ['limit' => 200]);
        $this->set(compact('ticket', 'users', 'tags'));
        $this->set('_serialize', ['ticket']);
    }

    /**
     * Résoudre un ticket
     */
    public function label($id = null){
        if($this->request->session()->read('Auth.User.role') == 'admin'){
            $ticket = $this->Tickets->get($id);
        }else{
            $ticket = $this->Tickets->get($id, [
                'conditions' => [
                    'Tickets.user_id' => $this->request->session()->read('Auth.User.id')
                ]
            ]);
        }

        if ($this->request->is(['post', 'put'])) {
            $ticket = $this->Tickets->patchEntity($ticket, $this->request->data);
             $this->Tickets->patchEntity($ticket, ['label' => 1]);
            if ($this->Tickets->save($ticket)) {
                $this->Flash->success(__('Votre ticket a bien été résolu'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Votre ticket n\'a pas pu être résolu, veuillez recommencer.'));
            }
        };
        $this->set('_serialize', ['ticket']);
    }
    /**
     * Suppression du ticket
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ticket = $this->Tickets->get($id);

        if ($this->Tickets->delete($ticket)) {
            $this->Flash->success(__('Votre ticket à bien était supprimé'));
        } else {
            $this->Flash->error(__('Votre ticket n\'a pas pu être supprimé'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
