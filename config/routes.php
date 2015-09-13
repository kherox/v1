<?php

use Cake\Core\Plugin;
use Cake\Routing\Router;

Router::defaultRouteClass('Route');

Router::scope('/', function ($routes) {

    /**
     * Accueil
     */
    $routes->connect(
        '/',
        [
            'controller' => 'Pages',
            'action' => 'display',
            'home'
        ]
    );
    
    $routes->connect(
        '/pages/*',
        [
            'controller' => 'Pages',
            'action' => 'display'
        ]
    );

    /**
     * Connexion
     */
    $routes->connect(
        '/login',
        [
            'controller' => 'Users',
            'action' => 'login'
        ]
    );

    /**
     * Inscription
     */
    $routes->connect(
        '/register',
        [
            'controller' => 'Users',
            'action' => 'add'
        ]
    );

    /**
     * Profil
     */
    $routes->connect(
        '/profil',
        [
            'controller' => 'Users',
            'action' => 'profile'
        ]
    );

    /**
     * Déconnexion
     */
    $routes->connect(
        '/logout',
        [
            'controller' => 'Users',
            'action' => 'logout'
        ]
    );

    $routes->fallbacks('InflectedRoute');
});

Plugin::routes();
