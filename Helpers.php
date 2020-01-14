<?php

class Helpers {

    public static function config(string $name)
    {
        include 'config.php';
        return $config[$name];
    }

    public static function getView()
    {
        include 'Resources/Views/index.php';
        return $view;
    }
}