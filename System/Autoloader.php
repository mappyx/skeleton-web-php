<?php

namespace System;

class Autoloader
{
    public static function register()
    {
        spl_autoload_register(function ($class) {
            $file = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
            $path = ROOT . $file;
            if (file_exists($path)) {
                require $path;
                return true;
            }
            return false;
        });
    }
}
