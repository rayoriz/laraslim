<?php

/**
 * Orders
 */
$app->get(
    '/dashboard/order/', 
    'OrderController:home'
)->setName('dash.order.home');

$app->get(
    '/dashboard/order/region/{region}', 
    'OrderController:getAll'
)->setName('dash.order.region');

$app->get(
    '/dashboard/order/add', 
    'OrderController:getAdd'
)->setName('dash.order.add');

$app->post(
    '/dashboard/order/add', 
    'OrderController:postAdd'
);

$app->get(
    '/dashboard/order/edit/{id}', 
    'OrderController:getEdit'
)->setName('dash.order.edit');

$app->post(
    '/dashboard/order/edit/{id}', 
    'OrderController:postEdit'
);

$app->get(
    '/dashboard/order/delete/{id}', 
    'OrderController:getDelete'
)->setName('dash.order.delete');