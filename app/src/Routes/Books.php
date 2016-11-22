<?php

/**
 * Books
 */
$app->get(
    '/dashboard/book/', 
    'BookController:home'
)->setName('dash.book.home');

$app->get(
    '/dashboard/book/region/{region}', 
    'BookController:getAll'
)->setName('dash.book.region');

$app->get(
    '/dashboard/book/add', 
    'BookController:getAdd'
)->setName('dash.book.add');

$app->post(
    '/dashboard/book/add', 
    'BookController:postAdd'
);

$app->get(
    '/dashboard/book/edit/{id}', 
    'BookController:getEdit'
)->setName('dash.book.edit');

$app->post(
    '/dashboard/book/edit/{id}', 
    'BookController:postEdit'
);

$app->get(
    '/dashboard/book/delete/{id}', 
    'BookController:getDelete'
)->setName('dash.book.delete');