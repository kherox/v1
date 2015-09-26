<?php
return [
    'Site' => [
        'base_url'  => 'http://127.0.0.1/OranTicket/',
        'name' => 'OranTicket',
        'description' => 'Créé des tickets afin de résoudre vos soucis/problèmes ',
        'github_url' => 'https://github.com/OranTicket/Site-Web',
        'timezone'   => 'Europe/Paris'
    ],
    'Paginate' => [
        'User' => [
            'indexUsers' => 20,
        ],
        'Ticket' => [
            'indexTickets' =>10,
            'viewUsers' => 30,
            'profileUsers' => 30
        ]
    ],

];
