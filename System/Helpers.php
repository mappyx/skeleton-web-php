<?php

namespace System;

class Helpers {

    private static $config;
    private static $routes;

    public function __construct()
    {
        if (!isset(self::$routes)) {
            include(ROOT . 'System/Routes.php');
            self::$routes = $routes;
        }
        if (!isset(self::$config)) {
            include(ROOT . 'System/config.php');
            self::$config = $config;
        }
    }

    public static function config(string $name)
    {
        if (!isset(self::$config)) {
            include(ROOT . 'System/config.php');
            self::$config = $config;
        }
        return self::$config[$name] ?? null;
    }

    public static function getRoute(string $name)
    {
        if (!isset(self::$routes)) {
            include(ROOT . 'System/Routes.php');
            self::$routes = $routes;
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
