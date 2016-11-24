<?php

return [
    // Place here middleware's that should be active.
    'active' => [
        '\Zeuxisoo\Whoops\Provider\Slim\WhoopsMiddleware',
        '\App\Middleware\Validation\ErrorsMiddleware',
        '\App\Middleware\Validation\OldInputMiddleware',
        '\App\Middleware\Views\CsrfMiddleware',
    ], 

    // Incase you want to set the middleware inactive but you
    // still want to know you included it place it here.
    'inactive' => [
    ]
];