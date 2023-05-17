<?php

namespace System;

class Helpers {

    private static $config;
    private static $routes;

    public static function config(string $name)
    {
        if (!isset(self::$config)) {
            self::$config = include(ROOT . 'config.php');
        }
        return self::$config[$name] ?? null;
    }

    public static function getRoute(string $name)
    {
        if (!isset(self::$routes)) {
            self::$routes = include(ROOT . 'Routes.php');
        }
        return self::$routes[$name] ?? null;
    }

    public static function getResourceJS(string $nameResource)
    {
        return URL . 'Resources/Js/' . $nameResource . '.js';
    }

    public static function getResourceCss(string $nameResource)
    {
        return URL . 'Resources/Css/' . $nameResource . '.css';
    }

    public static function getCurrentTime()
    {
        return date('Y-m-d H:i:s');
    }
}
