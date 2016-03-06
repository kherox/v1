<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

class PagesController extends AppController
{
    /**
     * @return \Cake\Network\Response|null
     */
    public function display()
    {
        $this->loadModel('Users');
        $this->loadModel('Tickets');

        // Nombre d'utilisateurs & tickets
        $Users = $this->Users->find('all')->count();
        $Tickets = $this->Tickets->find('all');

        $user = $this->Users->find('all');
        $path = func_get_args();
        $count = count($path);
        $page = $subpage = null;


        if (!$count) { return $this->redirect('/'); }
        if (!empty($path[0])) { $page = $path[0]; }
        if (!empty($path[1])) { $subpage = $path[1]; }

        $this->set(compact('Users', 'user', 'Tickets', 'page', 'subpage'));
        $this->set('tickets', $this->paginate($this->Tickets));
        $this->set('_serialize', ['tickets']);

        try {
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $e) {
            if (Configure::read('debug')) {  throw $e; }
            throw new NotFoundException();
        }
    }
}
