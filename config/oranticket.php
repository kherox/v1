<?php
return [
    'Site' => [
        'base_url'  => 'http://local.dev/OranTicket/',
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
