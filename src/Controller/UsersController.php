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
        $this->Auth->allow(['login', 'add', 'logout']);
    }

    public function initialize() {
        parent::initialize();

        $this->loadComponent('Flash');
    }

    /**
     * Visualisations de tout les tickets pour les admins/modos
     **/
    public function index()
    {
        $this->loadModel('Tickets');

        $user = $this->Auth->user();
        $tickets_count = $this->Tickets->find('all', ['conditions' => ['Tickets.user_id' => $user['id']]])->count();

        $this->set('tickets', $this->paginate($this->Tickets));
        $this->set('tickets_count', $tickets_count);
        $this->set('users', $this->paginate($this->Users));
        $this->set('_serialize', ['users']);
    }
    /**
     * Connexion votre compte
     */
    public function login()
    {
        $userLogin = $this->Auth->identify();

        if($this->Auth->user()){
            $this->Flash->error(__('Vous êtes déjà connecté'));
            return $this->redirect(['action' => 'profile']);
        }

        if ($userLogin) {
            if(!$userLogin['is_deleted'] == true){

                $this->Auth->setUser($userLogin);

                $user = $this->Users->newEntity($userLogin);

                $user->isNew(false);
                $user->last_login = new Time();
                $user->last_ip    = $this->request->clientIp();

                $url = $this->Auth->redirectUrl();

                $this->Users->save($user);
                $this->request->session()->write('Auth.User', $user);

                return $this->redirect($url);

            }else{
                $this->Flash->error(__('Ce compte à été supprimer'));
            }
        }
    }

    /**
     * Visualisations de tout les tickets pour les admins/modos
     **/
    public function view($id = null)
    {
        $user = $this->Auth->user();

        $this->loadModel('Tickets');
        $user = $this->Users->get($id, [
            'contain' => ['Tickets']
        ]);
        $tickets_count = $this->Tickets->find('all', ['conditions' => ['Tickets.user_id' => $user['id']]])->count();
        $this->paginate = [
            'maxLimit' => Configure::read('Paginate.Ticket.viewUsers'),
            'conditions' => ['Tickets.user_id' => $user['id']]
        ];

        $this->set('user', $user);
        $this->set('tickets', $this->paginate($this->Tickets));
        $this->set('tickets_count', $tickets_count);
        $this->set('_serialize', ['user']);
    }

    /**
     * Ajouté un compte
     **/
     public function add()
    {
        $user = $this->Users->newEntity();
        $user->last_login = new Time();
        $user->last_ip    = $this->request->clientIp();

        if($this->Auth->user()){
            $this->Flash->error(__('Vous êtes déjà connecté'));
            return $this->redirect(['action' => 'profile']);
        }

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);

            if ($this->Users->save($user)) {
                $this->Flash->success(__('Votre compte à bien était créé.'));
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

        $user = $this->Auth->user();
        $tickets_count = $this->Tickets->find('all', ['conditions' => ['Tickets.user_id' => $user['id']]])->count();
        $this->paginate = [
            'limit' => 5,
            'conditions' => ['Tickets.user_id' => $user['id']]
        ];
        $this->set('tickets', $this->paginate($this->Tickets));
        $this->set('tickets_count', $tickets_count);
        $this->set('user', $user);

    }

    /**
     * Édition de votre compte
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            $extension = '';
            $name_image = '';
            $repertoire = WWW_ROOT . 'img/upload/avatars/';
            $all_extension = ['jpg','gif','png','jpeg','svg'];

            // Upload
            if(isset($this->request->data['avatar_file']) && !empty($this->request->data['avatar_file'])){
                $extension  = pathinfo($this->request->data['avatar_file']['name'], PATHINFO_EXTENSION);
                if(in_array(strtolower($extension), $all_extension)){
                    $name_image = $user['id']. '-' . $user['username'] . '.' . $extension;

                    if(
                        move_uploaded_file($this->request->data['avatar_file']['tmp_name'] , $repertoire . $name_image)
                    ){
                        // Intervention
                        $manager = new ImageManager();
                        // Répertoire de l'avatar
                        $manager->make($repertoire . $name_image)
                        // Rogner et redimensionner l'avatar
                        ->fit(170)
                        // Sauvegarde de l'avatar
                        ->save($repertoire . $name_image);

                        $this->Users->patchEntity($user, ['avatar' => $name_image]);

                        return $this->redirect(['action' => 'profile']);
                    }
                }
            }

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
     * Supression de votre compte
     **/
    public function delete()
    {
        $user = $this->Users->get($this->Auth->user('id'));

        $user->is_deleted = true;

        if($this->Users->save($user)){
            $this->Flash->success("Votre compte à bien été supprimer!");
            return $this->redirect($this->Auth->logout());
        }
    }

    /**
     * Déconnexion
     */
    public function logout()
    {
        $this->Flash->success(__('Vous êtes bien déconnecté'));

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

            $code = md5(rand() . uniqid());

            $user->password_code = $code;
            $user->password_code_expire = new Time();


            $this->Users->save($user);

            $viewVars = [
                'userID' => $user->id,
                'name' => $user->username,
                'code' => $code
            ];

            $email = new Email();

            $email->profile('default')
                ->template('forgotPassword', 'default')
                ->emailFormat('html')
                ->from(['contact@oranticket.fr' => 'Mot de passe oublié'])
                ->subject(__('[OranTicket] Mot de passe oublié'))
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
                $this->Flash->success('Votre mot de passe à bien était modifier');

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
