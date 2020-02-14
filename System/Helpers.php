<?php
namespace System;

class Helpers {

    public static function config(string $name)
    {
        include 'config.php';
        return $config[$name];
    }

    public static function getRoute(string $name)
    {
        include 'Routes.php';
        return $routes[$name];
    }

    public static function getResourceJS(string $nameResource)
    {
        $path = URL . 'Resources/Js/' . $nameResource . '.js';
        echo $path;
    }

    public static function getResourceCss(string $nameResource)
    {
        $path = URL . 'Resources/Css/' . $nameResource . '.css';
        echo $path;
    }
}