<?php
return [
    'settings' => [
        // Slim Settings
        'determineRouteBeforeAppMiddleware' => false,
        // 'displayErrorDetails' => true,
        'addContentLengthHeader' => false,

        // Whoops
        'debug' => true,      // On/Off whoops error
        'whoops.editor' => 'sublime', // Support click to open editor

        // View settings
        'view' => [
            'template_path' => __DIR__ . '/../resources/views',
            'twig' => [
                'cache' => __DIR__ . '/../storage/cache/twig',
                'debug' => true,
                // 'cache' => true,
                'auto_reload' => true,
            ],
        ],

        // monolog settings
        'logger' => [
            'name' => 'app',
            'path' => __DIR__ . '/../storage/log/app.log',
        ],

        'db' => [
            'driver'        => 'mysql',
            'host'          => 'localhost',
            'database'      => 'laraslim',
            'port'          => '3306',
            'username'      => 'root',
            'password'      => '',
            'charset'       => 'utf8',
            'collation'     => 'utf8_unicode_ci',
            'prefix'        => '',
        ],
    ],
];
