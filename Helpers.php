<?php

class Helpers {
    public static function config(string $name)
    {
        include 'config.php';
        return $config[$name];
    }
}