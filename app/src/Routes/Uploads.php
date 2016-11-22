<?php

/**
 * The upload routes
 */
$app->get(
    '/dashboard/upload/',
    'UploadController:getUpload'
)->setName('dash.upload.home');

$app->post(
    '/dashboard/upload/',
    'UploadController:postUpload'
);