<?php

/**
 * Regions
 */
$app->get(
    '/dashboard/region/', 
    'RegionController:home'
)->setName('dash.region.home');

$app->get(
    '/dashboard/region/region/{region}', 
    'RegionController:getAll'
)->setName('dash.region.region');

$app->get(
    '/dashboard/region/add', 
    'RegionController:getAdd'
)->setName('dash.region.add');

$app->post(
    '/dashboard/region/add', 
    'RegionController:postAdd'
);

$app->get(
    '/dashboard/region/edit/{id}', 
    'RegionController:getEdit'
)->setName('dash.region.edit');

$app->post(
    '/dashboard/region/edit/{id}', 
    'RegionController:postEdit'
);

$app->get(
    '/dashboard/region/delete/{id}', 
    'RegionController:getDelete'
)->setName('dash.region.delete');