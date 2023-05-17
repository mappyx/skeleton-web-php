<?php

namespace System;

use ReflectionClass;
use ReflectionException;

class Factory
{
    const CLASS_ENTITY_NAMESPACE = 'App\\Entities\\';

    public function __construct()
    {
        // No es necesario hacer nada aquí
    }

    public function __destruct()
    {
        // No es necesario hacer nada aquí
    }

    public static function setup(string $class, array $args = []): ?object
    {
        try {
            $instance = new ReflectionClass($class);
            return $instance->newInstanceArgs($args);
        } catch (ReflectionException $e) {
            error_log('Error in setup Instance - ' . $e->getMessage());
            return null;
        }
    }

    public static function setupEntity(string $entityName, array $args = []): ?object
    {
        $className = self::CLASS_ENTITY_NAMESPACE . $entityName;
        return self::setup($className, $args);
    }
}
