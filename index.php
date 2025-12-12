<?php
// Secure Session Configuration
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_samesite', 'Lax');

// Environment Based Error Handling
$env = getenv('APP_ENV') ?: 'local';
if ($env === 'production') {
    ini_set('display_errors', 0);
    error_reporting(0);
} else {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

include_once('System/Helpers.php');
include_once('System/Autoloader.php');

use System\App;
use System\Autoloader;
use System\Helpers;

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)) . DS);
define('URL', Helpers::config('url'));

Autoloader::register();

$app = new App();

try {
    $app->run();
} catch (Exception $e) {
    echo $e;
}