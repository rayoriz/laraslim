<?php

// Add extensions
$view->addExtension(new Slim\Views\TwigExtension($c->get('router'), $c->get('request')->getUri()));
$view->addExtension(new Twig_Extension_Debug());

// Set global variables
$view->getEnvironment()->addGlobal('auth', [
    'check' => $c->auth->check(),
    'user' => $c->auth->user()
]);
$view->getEnvironment()->addGlobal('flash', $c->flash);