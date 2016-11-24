<?php

$laraslim->get('/', '\App\Controllers\HomeController:index')->setName('home');

// Auth routes.
$laraslim->get('/login', '\App\Controllers\Auth\AuthController:getSignIn')->setName('auth.signin');
$laraslim->post('/login', '\App\Controllers\Auth\AuthController:postSignIn');
$laraslim->get('/signup', '\App\Controllers\Auth\AuthController:getSignUp')->setName('auth.signup');
$laraslim->post('/signup', '\App\Controllers\Auth\AuthController:postSignUp');
$laraslim->get('/logout', '\App\Controllers\Auth\AuthController:getsignOut')->setName('auth.signout');
