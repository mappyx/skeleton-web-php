<?php
namespace System;

use ReflectionClass;

class Factory {

    public function __construct()
    {
        
    }
    public function __destruct()
    {

    }

    public static function setup(string $class, array $args = [])
    {
        try {
            $instance = new ReflectionClass($class);
            return $instance->newInstanceArgs($args);
        } catch (\Exception $e) {
            print_r('Error in setup Instance - '.$e);
        }
    }
}