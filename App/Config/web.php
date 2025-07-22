<?php
return 
[
    'home' => [
        'controller' => 'HomeController',
        'middlewares' => 
        [
        ],
    ],
    'fallback' => [
        'controller' => 'FallbackController',
        'middlewares' => 
        [
            ['middleware-name' =>  'middlewareQueNoExiste',
            'middleware-result' => 'true']
        ],
    ]
    // Agrega más rutas según sea necesario
];