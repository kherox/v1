<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Mailer\Email;
use Emojione\Client;
use Emojione\Ruleset;
use Parsedown;

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
        $this->loadComponent('Recaptcha.Recaptcha');
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
        $user = $this->Auth->user();
        $this->paginate = [
            'maxLimit' =>  Configure::read('Paginate.Ticket.indexTickets')
        ];

        $tickets = $this->Tickets
            ->find()
            ->contain(['Comments'])
            ->where(['report' => 0])
            ->order([
                'created' => 'desc'
            ]);

        if(!@$user->role == 'admin'){
           $tickets->where(['public' => 0]);
        }

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
            'contain' => ['Users', 'Comments'],
            'conditions' => [
                'Tickets.report' => 0
            ]
        ]);

        // EMOJIONE
        $client = new Client(new Ruleset());
        $client->imageType = 'svg';

        // MARKDOWN
        $Parsedown = new Parsedown();
        $Parsedown->setMarkupEscaped(true);
        $html = $Parsedown->text($ticket->content);

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
        $this->set(compact('html'));
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
            if ($this->Recaptcha->verify()) {
                $ticket = $this->Tickets->patchEntity($ticket, $this->request->data);
                $ticket->public  = $this->request->data(['public']);
                $ticket->user_id = $user['id'];
                // Je passe mes variables à mon template mail
                $viewVars = [
                    'subject' => $ticket->subjects,
                    'content' => nl2br($ticket->content)
                ];

                // SAUVEGARDE TICKET
                if ($this->Tickets->save($ticket)) {
                    $email = new Email();

                    if($this->request->data(['mail']) == true){
                        $email->profile('default')
                            ->template('ticket', 'default')
                            ->emailFormat('html')
                            ->from(['contact@oranticket.fr' => 'Copie Ticket'])
                            ->subject(__('[OranTicket] Copie Ticket'))
                            ->to($user->mail)
                            ->viewVars($viewVars)
                            ->send();
                    }

                    $this->Flash->success(__('Votre ticket à bien était sauvegarder.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('Votre ticket n\'a pas plus être sauvegarder, veuillez recommencer.'));
                }
            } else {
                $this->Flash->error('Veuillez valider le Recaptcha');
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
                return $this->redirect(['action' => 'view', $id]);
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
     * Ticket de l'utilisateur
     */
    public function me($id = null){
        $user = $this->Auth->user();

        $this->paginate = [
            'maxLimit' =>  Configure::read('Paginate.TicketMe.indexTicketMe'),
            'conditions' => ['Tickets.user_id' => $user['id']]
        ];

        $tickets = $this->Tickets
            ->find()
            ->order([
                'created' => 'desc'
            ]);
        $ticketss = $this->Tickets->find('all')->where(['Tickets.user_id' => $user['id']])->count();

        $tickets = $this->paginate($tickets);

        $this->set(compact('tickets'));
        $this->set(compact('ticketss'));
        $this->set('user', $user);
    }

    /**
     * Report un ticket
     */
    public function report($id = null){
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
            $this->Tickets->patchEntity($ticket, ['report' => 1]);

            if ($this->Tickets->save($ticket)) {
                $this->Flash->success(__('Merci d\'avoir signalé ce ticket.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Ce ticket n\'a pas pu être signalé, veuillez recommencer.'));
            }
        };

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
