<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\Mailer\Email;
use Identicon\Identicon;
use Intervention\Image\ImageManager;


class UsersController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        // J'autorise aux utilisateurs non inscrit à accédez à c'est pages.
        $this->Auth->allow(['login', 'add', 'logout']);
    }

    public function initialize() {
        parent::initialize();

        $this->loadComponent('Flash');
        $this->loadComponent('Recaptcha.Recaptcha');

    }

    /**
     * Visualisations de tout les membres
     **/
    public function index()
    {
        $this->loadModel('Tickets');

        $user = $this->Auth->user();
        $tickets_count =
            $this->Tickets->find('all', [
                'conditions' => [
                    'Tickets.user_id' => $user['id']
                ]
            ])->count();

        $users = $this->Users
            ->find('all')
            ->order(['created' => 'DESC']);
        ;


        $this->set('tickets', $this->paginate($this->Tickets));
        $this->set('users', $this->paginate($users));
        $this->set(compact('tickets_count'));
        $this->set('_serialize', ['users']);
    }

    /**
     * Connexion
     */
    public function login()
    {
        $userLogin = $this->Auth->identify();

        // Si l'utilisateur est déjà connecté
        if($this->Auth->user()){
            $this->Flash->error(__('Vous êtes déjà connecté'));
            return $this->redirect(['action' => 'profile']);
        }

        if ($userLogin) {
            // Si l'utilisateur n'a pas supprimé sont compte
            if(!$userLogin['is_deleted'] == true){
                $this->Auth->setUser($userLogin);

                $user = $this->Users->newEntity($userLogin);

                $user->isNew(false);
                $user->last_login = new Time();
                $user->last_ip    = $this->request->clientIp();

                $session = $this->request->session();
                $url = $this->Auth->redirectUrl();

                $this->Users->save($user);

                $session->write('Auth.User', $user);
                $session->write('SiteWeb.background_body', $user->background_body);
                $session->write('SiteWeb.background_menu', $user->background_menu);

                return $this->redirect($url);
            }else{
                $this->Flash->error(__('Ce compte à été supprimer'));
            }
        }
    }

    /**
     * Visualisations d'un ticket
     **/
    public function view($id = null)
    {
        $this->loadModel('Tickets');
        $this->loadModel('Comments');

        $user = $this->Auth->user();
        $user = $this->Users->get($id, ['contain' => ['Tickets']]);

        // Nombre de ticket de l'utilisateur
        $tickets_count =
            $this->Tickets->find('all', [
                'conditions' => [
                    'Tickets.user_id' => $user['id']
                ]
            ])->count();

        // Nombre de commentaire de l'utilisateur
        $comments_count =
            $this->Comments->find('all', [
                'conditions' => [
                    'Comments.user_id' => $user['id']
                ]
            ])->count();

        $this->paginate = [
            'maxLimit' => Configure::read('settings.ticket.paginate.profil'),
            'conditions' => ['Tickets.user_id' => $user['id']]
        ];

        $this->set(compact('user','tickets_count', 'comments_count'));
        $this->set('tickets', $this->paginate($this->Tickets));
        $this->set('_serialize', ['user']);
    }

    /**
     * Ajouter un compte
     **/
    public function add()
    {
       $user = $this->Users->newEntity();

       $user->last_login = new Time();
       $user->last_ip = $this->request->clientIp();

       // Si l'utilisateur est déjà connecté
       if ($this->Auth->user()) {
           $this->Flash->error(__('Vous êtes déjà connecté'));
           return $this->redirect(['action' => 'profile']);
       }

       if ($this->request->is('post')) {
           $user = $this->Users->patchEntity($user, $this->request->data);

           if ($this->Users->save($user)) {
               $this->Flash->success(__('Votre compte à bien été créé.'));

               return $this->redirect(['action' => 'index']);
           } else {
               $this->Flash->error(__('Votre compte n\'a pas plus être créé.'));
           }
       }

       $this->set(compact('user'));
       $this->set('_serialize', ['user']);
   }
    /**
     * Mon profile
     */
    public function profile(){
        $this->loadModel('Tickets');
        $this->loadModel('Comments');

        $user = $this->Auth->user();
        // Nombre de ticket, commentaire d'un utilisateur
        $tickets_count = $this->Tickets->find('all', ['conditions' => ['Tickets.user_id' => $user['id']]])->count();
        $comments_count = $this->Comments->find('all', ['conditions' => ['Comments.user_id' => $user['id']]])->count();

        $this->paginate = [
            'limit' => 5,
            'conditions' => ['Tickets.user_id' => $user['id']]
        ];

        $this->set('tickets', $this->paginate($this->Tickets));
        $this->set(compact(['tickets_count', 'user', 'comments_count']));
    }

    /**
     * Édition de votre compte
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);

            $user->background_body  = $this->request->data(['background_body']);
            $user->background_menu  = $this->request->data(['background_menu']);

            // Session
            $session = $this->request->session();

            $session->write('SiteWeb.background_body', $user->background_body);
            $session->write('SiteWeb.background_menu', $user->background_menu);

            if ($this->Users->save($user)) {
                $this->Flash->success(__('Votre compte a bien été édité.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Votre compte n\'a pas pu être édité.'));
            }
        }

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Désactivé votre compte
     **/
    public function delete($id = null)
    {
        $user = $this->Users->get($id);

        $user->is_deleted = true;

        if($this->Users->save($user)){
            $this->Flash->success("Votre compte à bien été désactiver!");
            return $this->redirect(['controller' => 'Pages', 'action' => 'index']);
        }
    }

    /**
     * Réactivé votre compte (Dans l'administration)
     */
    public function active($id = null){
        $user = $this->Users->get($id);
        $user->is_deleted = null;

        if($this->Users->save($user)){
            $this->Flash->success("Le compte à bien été réactiver!");
            return $this->redirect(['controller' => 'Pages', 'action' => 'index']);
        }
    }
    /**
     * Déconnexion
     */
    public function logout()
    {
        $this->Flash->success(__('Vous êtes bien déconnecté'));
        $this->request->session()->destroy();

        return $this->redirect($this->Auth->logout());
    }

    /**
     * Mot de passe oublié
     */
    public function forgot_password(){
        if($this->Auth->user()) {
            $this->Flash->error(__('Vous êtes déjà connecté'));
            return $this->redirect(['action' => 'profile']);
        }

        $user = $this->Users->newEntity($this->request->data);

        if($this->request->is('post')){
            $user = $this->Users->find()->where(['Users.mail' => $this->request->data['email']])->first();

            if(is_null($user)){
                $this->Flash->error(__("Ce code est incorrect."));
                $this->redirect(['controller' => 'pages', 'action' => 'home']);
            }

            // Génération d'un code
            $code = md5(rand() . uniqid());

            $user->password_code = $code;
            $user->password_code_expire = new Time();

            $this->Users->save($user);
            // Les variables qui vont ce retrouver dans la vu
            $viewVars = [
                'userID' => $user->id,
                'name' => $user->username,
                'code' => $code
            ];

            // Email
            $email = new Email();
            $email
                ->profile('default')
                ->template('forgotPassword', 'default')
                ->emailFormat('html')
                ->from(['contact@Ticki.fr' => 'Mot de passe oublié'])
                ->subject(__('[Ticki] Mot de passe oublié'))
                ->to($user->mail)
                ->viewVars($viewVars)
                ->send();

            $this->Flash->success("Votre email à bien était envoyer.");
        }

        $this->set(compact('user'));
    }

    /**
     * Nouveaux mot de passe
     */
    public function reset_password(){
        if($this->Auth->user()) {
            $this->Flash->error(__('Vous êtes déjà connecté'));
            return $this->redirect(['action' => 'profile']);
        }

        $user = $this->Users
        ->find()
        ->where([
            'Users.password_code' => $this->request->code,
            'Users.id' => $this->request->id
            ])
        ->first();

        $expire = $user->password_code_expire->timestamp + (Configure::read('Settings.User.ResetPassword.expire_code') * 60);

        if ($expire < time()) {
            $this->Flash->error(__("Le code est expiré, veuillez renvoyez un mail."));
            return $this->redirect(['action' => 'forgot_password']);
        }

        if(empty(trim($this->request->code))){
            $this->Flash->error(__("Vous n'avez pas envoyer de mail de récupération pour votre mot de passe."));
            $this->redirect(['controller' => 'pages', 'action' => 'home']);
        }

        if ($this->request->is(['post', 'put'])) {
            $this->Users->patchEntity($user, $this->request->data);

            if ($this->Users->save($user)) {
                $this->Flash->success('Votre mot de passe à bien été modifié');

                $user->password_code = null;
                $user->password_code_expire = new Time();
                $user->password_reset_count = $user->password_reset_count + 1;

                $this->Users->save($user);
                return $this->redirect(['controller' => 'users', 'action' => 'login']);
            }
        }

        $this->set(compact('user'));
    }
}
