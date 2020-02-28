<?php
namespace System;

use ReflectionClass;

class Factory {

    const CLASS_ENTITY_DIR = 'App\Entities\\';

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

    public static function setupEntity(string $entityName, array $args = [])
    {
        return self::setup(self::CLASS_ENTITY_DIR.$entityName, $args);   
    }
}