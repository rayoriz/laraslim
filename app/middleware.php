<?php
// Application middleware

// $app->add(new \Slim\Csrf\Guard);
$app->add(new \App\Middleware\Validation\ErrorsMiddleware($container));
$app->add(new \App\Middleware\Validation\OldInputMiddleware($container));
$app->add(new \App\Middleware\Views\CsrfMiddleware($container));