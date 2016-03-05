<?php
return [
    'site' => [
        'name' => 'Ticki',
        'base_url'  => 'http://127.0.0.1/Ticki/',
        'description' => 'Créé des tickets afin de résoudre vos soucis/problèmes ',
        'github_url' => 'https://github.com/Gynidark/Ticki',
        'timezone'   => 'Europe/Paris',
        'debug'      => false
    ],

    'settings' => [
        'user' => [
            'resetpassword' => [
                'expire_code' => 30
            ],

            'paginate' => [
                'index' => 20,
            ]
        ],

        'ticket' => [

            'paginate' => [
                // page ticketme
                'ticketme' => 10,
                // page index
                'index' =>10,
                // page profil
                'profil' => 30
            ]
        ]
    ]
];
