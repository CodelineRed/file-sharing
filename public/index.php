<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

error_reporting(E_ALL);
//ini_set('display_errors', TRUE);
//ini_set('display_startup_errors', TRUE);
define('FILE_SHARING_VERSION', '4.1.0');
define('FILE_SHARING_TIMESTAMP', '2023-09-01T21:15:00+02:00');

require __DIR__ . '/../vendor/autoload.php';

session_start();
date_default_timezone_set('UTC');

// Instantiate the app
$generalSettings = require __DIR__ . '/../config/settings.php';
$additionalSettings = [];

if (is_readable(__DIR__ . '/../config/additional-settings.php')) {
    $additionalSettings = require __DIR__ . '/../config/additional-settings.php';
}

$settings = array_replace_recursive($generalSettings, $additionalSettings);

// Handle localisation
require __DIR__ . '/../src/localisation.php';

//$app = new \Slim\App($settings);
$app = \App\Container\AppContainer::getInstance($settings);

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register middleware
require __DIR__ . '/../src/middleware.php';

// Register routes
require __DIR__ . '/../src/routes.php';

// Run app
$app->run();
