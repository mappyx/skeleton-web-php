<?php

namespace System;

use Exception;
use System\Factory;
use System\Contracts\RouteInterface;
use System\CsrfMiddleware;
use ReflectionMethod;

class Router
{

    public static function run(RouteInterface $route)
    {
        // Verify CSRF token for state-changing requests
        CsrfMiddleware::verify(new Request());
        
        $urlDefine = Helpers::getRoute($route->parseStringRoute(new Request));
        if (is_array($urlDefine)) {
            // Validate controller name to prevent directory traversal
            if (!preg_match('/^[a-zA-Z0-9_]+$/', $urlDefine['controller'])) {
                throw new Exception("Invalid controller name");
            }

            // Whitelist allowed controllers (prevent access to System classes)
            $allowedControllers = self::getAllowedControllers();
            if (!in_array($urlDefine['controller'], $allowedControllers)) {
                throw new Exception("Controller not allowed: " . $urlDefine['controller']);
            }

            $file = ROOT . "App/Controllers" . DS . $urlDefine['controller'] . ".php";
    
            if (is_readable($file)) {
                try {
                    require_once($file);
                    $class = 'App\Controllers\\' . $urlDefine['controller'];
                    
                    $instanceController = Factory::setup($class);
                    
                    $dataController = self::callMethodWithParametersFromController($instanceController, $urlDefine['action'], $route);
                   
                } catch(Exception $e) {
                    error_log('Controller error: ' . $e->getMessage());
                    throw new Exception('An error occurred processing your request');
                }
            } 
    
            // Validate view path
            if (strpos($urlDefine['view'], '..') !== false) {
                throw new Exception("Invalid view path");
            }

            $path = ROOT . "Resources/Views/" . $urlDefine['view'] . '.php';
    
            if (is_readable($path)) {
                require_once($path);
            } else {
                echo $path;
            }
        } else {
            header("Status: 301 Moved Permanently");
            header("Location: ".Helpers::config('url'));
        }
    }

    /**
     * Get list of allowed controllers from App/Controllers directory
     */
    protected static function getAllowedControllers(): array
    {
        static $controllers = null;
        
        if ($controllers === null) {
            $controllers = [];
            $controllerPath = ROOT . 'App/Controllers/';
            
            if (is_dir($controllerPath)) {
                $files = scandir($controllerPath);
                foreach ($files as $file) {
                    if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
                        $controllers[] = pathinfo($file, PATHINFO_FILENAME);
                    }
                }
            }
        }
        
        return $controllers;
    }

    protected static function callMethodWithParametersFromController($class, string $method, RouteInterface $route)
    {
        $fire_args = array();
        $args = $route->getParamsFromUrl(new Request);
        
        $reflection = new ReflectionMethod($class, $method);

        if (empty($reflection->getParameters())) {
            return call_user_func_array(array($class, $method), []);
        }

        foreach($reflection->getParameters() as $arg) {
            if ($args[$arg->name]) {
                $fire_args[$arg->name] = $args[$arg->name];
            } else {
                $fire_args[$arg->name] = null;
            }
        }
        return call_user_func_array(array($class, $method), $fire_args);
    }
}
