<?php
// Secure Session Configuration
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_samesite', 'Strict');
ini_set('session.cookie_secure', 1);  // Only HTTPS (disable in local if needed)
ini_set('session.gc_maxlifetime', 1800);  // 30 minutes timeout
ini_set('session.use_strict_mode', 1);

// Environment Based Error Handling
$env = getenv('APP_ENV') ?: 'local';
if ($env === 'production') {
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    ini_set('error_log', ROOT . 'logs/error.log');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

include_once('System/Helpers.php');
include_once('System/Autoloader.php');

use System\App;
use System\Autoloader;
use System\Helpers;
use System\Logger;

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)) . DS);
define('URL', Helpers::config('url'));

Autoloader::register();

$app = new App();

try {
    $app->run();
} catch (Exception $e) {
    // Log the error securely
    error_log('Application Error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine());
    
    // Show generic error to user
    if ($env === 'production') {
        http_response_code(500);
        echo 'An error occurred. Please try again later.';
    } else {
        // Show detailed error in development
        echo '<pre>' . htmlspecialchars($e->__toString()) . '</pre>';
    }
}