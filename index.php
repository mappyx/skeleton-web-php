<?php
session_start();
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