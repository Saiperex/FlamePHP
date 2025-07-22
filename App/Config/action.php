<?php
return [
    'ejecutador' => [
        'action' => 'ApareceCuadradito',
        'middlewares' => [
            
        ]
    ],
    'ejecutador2' => [
        'action' => 'aparecerCuadradito2',
        'middlewares' => [
            [
                'middleware-name' => 'ValidarCamposMiddleware',
                'middleware-data' => 'data', //el middleware-data determina que se va a procesar. Si data o el files. Esto separa logica de cada maniulacion de datos
                'middleware-result' => true,
            ],
            [
                'middleware-name' => 'ProcesarArchivoMiddleware',
                'middleware-data' => 'files',
                'middleware-result' => true,
            ],
        ]
    ],
];
