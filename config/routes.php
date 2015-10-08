<?php

use Cake\Core\Plugin;
use Cake\Routing\Router;

Router::defaultRouteClass('Route');
Router::extensions('json', 'xml');

Router::prefix('admin', function ($routes) {
    // Accueil
    $routes->connect('/', ['controller' => 'Users','action' => 'index']);

    $routes->fallbacks();
});

Router::scope('/', function ($routes) {

    // Accueil
    $routes->connect('/', ['controller' => 'Pages','action' => 'display', 'home']);

    // Pages
    $routes->connect('/pages/*',['controller' => 'Pages','action' => 'display']);

    // Connexion
    $routes->connect('/login',['controller' => 'Users','action' => 'login']);

    // Récupération mot de passe
    $routes->connect(
        '/users/reset_password/:code.:id',['controller' => 'Users','action' => 'reset_password'],
        ['_name' => 'users-resetpassword','pass' => ['id','code'],'id' => '[0-9]+']
    );

    // Inscription
    $routes->connect('/register',['controller' => 'Users','action' => 'add']);

    // Profil
    $routes->connect('/profil',['controller' => 'Users','action' => 'profile']);

    // Déconnexion
    $routes->connect('/logout',['controller' => 'Users','action' => 'logout']);

    // Administration
    $routes->fallbacks('InflectedRoute');
});

Plugin::routes();
