<?php
include_once('app.php');
include_once('System/Autoloader.php');

Autoloader::register();

$app = new App();

try {
    $app->run();
} catch (Exception $e) {

}