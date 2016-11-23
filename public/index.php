<?php
// To help the built-in PHP dev server, check if the request was actually for
// something which should probably be served as a static file
if (PHP_SAPI === 'cli-server' && $_SERVER['SCRIPT_FILENAME'] !== __FILE__) {
    return false;
}

require __DIR__ . '/../vendor/autoload.php';

session_start();

// Instantiate the app
$config = require __DIR__ . '/../base/config/config.php';
$baseConfig = require __DIR__ . '/../base/config/base.config.php';
$settings = array_merge_recursive($config, $baseConfig);

// Keep the validation stuff in here,
\Respect\Validation\Validator::with('App\\Validation\\Rules\\');

$laraslim = new \ConceptCore\LaraSlim\AppStarter($settings);
$laraslim->startUp();

// Register routes
require __DIR__ . '/../routes/web.php';

// Run!
$laraslim->run();