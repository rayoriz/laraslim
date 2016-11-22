<?php
// DIC configuration
use Respect\Validation\Validator as V;

$container = $app->getContainer();

//SLIM CSRF PROTECTION
$container['csrf'] = function ($container) {
    return new \Slim\Csrf\Guard;
};

$container['auth'] = function ($container) {
    return new \App\Auth\Auth;
};

// Eloquent database
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container->get('settings')['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

// -----------------------------------------------------------------------------
// Service providers
// -----------------------------------------------------------------------------

// Flash messages
$container['flash'] = function ($c) {
    return new Slim\Flash\Messages;
};

use Zeuxisoo\Whoops\Provider\Slim\WhoopsMiddleware;
if ($container->get('settings')['debug'] === false) {
    $container['errorHandler'] = function ($c) {
        return function ($request, $response, $exception) use ($c) {
            $data = [
                'code' => $exception->getCode(),
                'message' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => explode("\n", $exception->getTraceAsString()),
            ];
            return $c->get('response')->withStatus(500)
                    ->withHeader('Content-Type', 'application/json')
                    ->write(json_encode($data));
        };
    };
}else{
    $app->add(new WhoopsMiddleware);
}

// Twig
$container['view'] = function ($c) {
    $settings = $c->get('settings');
    $view = new Slim\Views\Twig($settings['view']['template_path'], $settings['view']['twig']);

    // Add extensions
    $view->addExtension(new Slim\Views\TwigExtension($c->get('router'), $c->get('request')->getUri()));
    $view->addExtension(new Twig_Extension_Debug());

    // Set global variables
    $view->getEnvironment()->addGlobal('auth', [
        'check' => $c->auth->check(),
        'user' => $c->auth->user()
    ]);
    $view->getEnvironment()->addGlobal('flash', $c->flash);

    return $view;
};

// Validator
$container['validator'] = function ($c) {
    return new App\Validation\Validator($c);
};

// Database
$container['db'] = function ($c) use ($capsule) {

    return $capsule;
};


// -----------------------------------------------------------------------------
// Service factories
// -----------------------------------------------------------------------------

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings');
    $logger = new Monolog\Logger($settings['logger']['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['logger']['path'], Monolog\Logger::DEBUG));
    return $logger;
};

// -----------------------------------------------------------------------------
// Controller factories
// -----------------------------------------------------------------------------

$container['home'] = function ($c) {
    return new App\Controllers\HomeController($c);
};

// Auth
$container['authC'] = function ($c) {
    return new App\Controllers\Auth\AuthController($c);
};

$container['passC'] = function ($c) {
    return new App\Controllers\Auth\PasswordController($c);
};

// -----------------------------------------------------------------------------
// Rules
// -----------------------------------------------------------------------------

V::with('App\\Validation\\Rules\\');
