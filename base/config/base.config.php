<?php
return [
    'settings' => [
        'base' => [

            'whoops' => true,
            'whoopsConf' => [
                // Whoops
                'debug' => true, // On/Off whoops error
                'whoops.editor' => 'sublime', // Support click to open editor
            ],

            'csrf' => true,
            'auth' => true,
            'flash' => true,

            'db' => true,
            'dbConf' => [
                'driver'        => 'mysql',
                'host'          => 'localhost',
                'database'      => 'laraslim',
                'port'          => '3306',
                'username'      => 'root',
                'password'      => 'root',
                'charset'       => 'utf8',
                'collation'     => 'utf8_unicode_ci',
                'prefix'        => '',
            ],

            'log' => true,
            'logger' => [
                'name' => 'laraslim',
                'path' => __DIR__ . '/../../storage/log/app.log',
            ],

            'viewEngine' => [
                'class' => 'Slim\Views\Twig',
                'resourcePath' => __DIR__ . '/../../resources/views',
                'settings' => [
                    'extensions' => __DIR__ . '/../ViewExtensions/Twig.php',
                    'cache' => __DIR__ . '/../../storage/cache/twig',
                    'debug' => true,
                    // 'cache' => true,
                    'auto_reload' => true,
                ]
            ],
        ]
    ]
];
