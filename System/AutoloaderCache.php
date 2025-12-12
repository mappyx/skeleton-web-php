<?php

namespace System;

class AutoloaderCache
{
    private static $cacheFile = null;
    private static $cache = [];
    
    public static function init()
    {
        self::$cacheFile = ROOT . 'logs/autoloader_cache.php';
        
        // Load cache in production
        if (getenv('APP_ENV') === 'production' && file_exists(self::$cacheFile)) {
            self::$cache = include self::$cacheFile;
        }
    }
    
    public static function get(string $class): ?string
    {
        return self::$cache[$class] ?? null;
    }
    
    public static function set(string $class, string $path): void
    {
        self::$cache[$class] = $path;
    }
    
    public static function save(): void
    {
        if (getenv('APP_ENV') === 'production') {
            $content = "<?php\nreturn " . var_export(self::$cache, true) . ";\n";
            file_put_contents(self::$cacheFile, $content);
        }
    }
}
