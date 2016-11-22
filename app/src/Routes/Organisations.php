<?php

/**
 * Organisations
 */
$app->get(
    '/dashboard/organisation/', 
    'OrganisationController:home'
)->setName('dash.orgs.home');

$app->get(
    '/dashboard/organisation/region/{region}', 
    'OrganisationController:getAll'
)->setName('dash.orgs.region');

$app->get(
    '/dashboard/organisation/add', 
    'OrganisationController:getAdd'
)->setName('dash.orgs.add');

$app->post(
    '/dashboard/organisation/add', 
    'OrganisationController:postAdd'
);

$app->get(
    '/dashboard/organisation/edit/{id}', 
    'OrganisationController:getEdit'
)->setName('dash.orgs.edit');

$app->post(
    '/dashboard/organisation/edit/{id}', 
    'OrganisationController:postEdit'
);

$app->get(
    '/dashboard/organisation/delete/{id}', 
    'OrganisationController:getDelete'
)->setName('dash.orgs.delete');