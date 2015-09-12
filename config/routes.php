<?php

use Cake\Core\Plugin;
use Cake\Routing\Router;

Router::defaultRouteClass('Route');

Router::scope('/', function ($routes) {

    $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

    /**
     * ESPACE MEMBRE
     */
    $routes->connect('/login', ['controller' => 'Users', 'action' => 'login']);
    $routes->connect('/register', ['controller' => 'Users', 'action' => 'add']);
    $routes->connect('/profil', ['controller' => 'Users', 'action' => 'profile']);
    $routes->connect('/logout', ['controller' => 'Users', 'action' => 'logout']);

    $routes->fallbacks('InflectedRoute');
});

Plugin::routes();
