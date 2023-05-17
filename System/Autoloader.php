<?php

namespace System;

class Autoloader
{
    public static function register()
    {
        spl_autoload_register(function ($class) {
            $file = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
            $path = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . $file;
            if (file_exists($path)) {
                require_once $path;
                return true;
            }
            return false;
        });
    }
}
