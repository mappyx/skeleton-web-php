<?php

namespace System;

require_once('AutoloaderCache.php');

class Autoloader
{
    public static function register()
    {
        AutoloaderCache::init();
        spl_autoload_register([__CLASS__, 'autoload']);
        
        // Save cache on shutdown in production
        if (getenv('APP_ENV') === 'production') {
            register_shutdown_function([AutoloaderCache::class, 'save']);
        }
    }

    public static function autoload($class)
    {
        // Check cache first
        $cachedPath = AutoloaderCache::get($class);
        if ($cachedPath && file_exists($cachedPath)) {
            require_once $cachedPath;
            return;
        }
        
        // Original autoload logic
        $class = str_replace('\\', DS, $class);
        $file = ROOT . $class . '.php';
        
        if (file_exists($file)) {
            require_once $file;
            AutoloaderCache::set($class, $file);
        }
    }
}
