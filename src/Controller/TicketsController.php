<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Emojione\Client;
use Emojione\Ruleset;

class TicketsController extends AppController
{
    /**
     * Pagination & Order
     **/
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
            ->order([
                'created' => 'desc'
            ]);

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
        // EMOJIONE
        $client = new Client(new Ruleset());
        $client->imageType = 'svg';
        // AJOUT D'UN COMMENTAIRE
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
        $this->set('client', $client);
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

    public function me($id = null){
        $user = $this->Auth->user();
        $ticketss = $this->Tickets->find('all', ['conditions' => ['Tickets.user_id' => $user['id']]])->count();


        $this->paginate = [
            'maxLimit' =>  Configure::read('Paginate.TicketMe.indexTicketMe'),
            'conditions' => ['Tickets.user_id' => $user['id']]
        ];

        $this->set('tickets', $this->paginate($this->Tickets));
        $this->set(compact('ticketss'));
        $this->set('user', $user);
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
        //$this->request->allowMethod(['public', 'post', 'delete']);
        $ticket = $this->Tickets->get($id);

        if ($this->Tickets->delete($ticket)) {
            $this->Flash->success(__('Votre ticket à bien était supprimé'));
        } else {
            $this->Flash->error(__('Votre ticket n\'a pas pu être supprimé'));
        }

        return $this->redirect(['action' => 'index']);
    }


    /**
     * COMMENTAIRES
     */

    /**
     * Suppression d'un commentaire
     */
    public function deleteComment($id = null)
    {
        $this->loadModel('Comments');
        $this->request->allowMethod(['post', 'delete']);
        $comment = $this->Comments->get($id);

        if ($this->Comments->delete($comment)) {
            $this->Flash->success(__('Votre commentaire à bien était supprimé'));
        } else {
            $this->Flash->error(__('Votre commentaire n\'a pas pu être supprimé'));
        }

        return $this->redirect($this->referer());
    }

    /**
     * Édition d'un commentaire
     */
    public function editComment($id = null){
        $this->loadModel('Comments');

        $users = $this->Comments->Users->find('list', ['limit' => 200]);

        if($this->request->session()->read('Auth.User.role') == 'admin'){
            $comment = $this->Comments->get($id, [
                'contain' => ['Users']
            ]);
        }else{
            $comment = $this->Comments->get($id, [
                'contain' => ['Users'],
                'conditions' => [
                    'Comments.user_id' => $this->request->session()->read('Auth.User.id')
                ]
            ]);
        }

        if ($this->request->is(['post', 'put'])) {
            $ticket = $this->Comments->patchEntity($comment, $this->request->data);
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('Votre commentaire a bien été édité'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Votre commentaire n\'a pas pu être édité, veuillez recommencer.'));
            }
        }

        $this->set(compact('comment', 'users'));
        $this->set('_serialize', ['comment']);
    }
}
