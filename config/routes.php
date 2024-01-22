<?php

return [
    'routes' => [
        [
            'route'      => '/',
            'controller' => 'Application\Controller\index',
            'method'     => 'index',
        ],
        [
            'route'      => 'users',
            'controller' => 'Application\Controller\User',
            'method'     => 'index',
        ],
        [
            'route'      => 'add-user',
            'controller' => 'Application\Controller\User',
            'method'     => 'add',
        ],
    ]
];