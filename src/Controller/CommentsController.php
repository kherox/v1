<?php
namespace App\Controller;

use App\Controller\AppController;

class CommentsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Tickets']
        ];

        $this->set('comments', $this->paginate($this->Comments));
        $this->set('_serialize', ['comments']);
    }

    /**
     * View method
     *
     * @param string|null $id Comment id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $comment = $this->Comments->get($id, [
            'contain' => ['Users', 'Tickets']
        ]);

        $this->set('comment', $comment);
        $this->set('_serialize', ['comment']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $comment = $this->Comments->newEntity();
        $users = $this->Comments->Users->find('list', ['limit' => 200]);
        $tickets = $this->Comments->Tickets->find('list', ['limit' => 200]);

        if ($this->request->is('post')) {
            $comment = $this->Comments->patchEntity($comment, $this->request->data);
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));
                //return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The comment could not be saved. Please, try again.'));
            }
        }

        $this->set(compact('comment', 'users', 'tickets'));
        $this->set('_serialize', ['comment']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Comment id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {

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
                return $this->redirect(['controller' => 'Tickets', 'action' => 'view', $ticket->id]);
            } else {
                $this->Flash->error(__('Votre commentaire n\'a pas pu être édité, veuillez recommencer.'));
            }
        }

        $users = $this->Comments->Users->find('list', ['limit' => 200]);
        $this->set(compact('comment', 'users'));
        $this->set('_serialize', ['comment']);
    }
}
