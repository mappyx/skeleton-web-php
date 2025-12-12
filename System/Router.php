<?php

namespace System;

use Exception;
use System\Factory;
use System\Contracts\RouteInterface;
use ReflectionMethod;

class Router
{

    public static function run(RouteInterface $route)
    {
        $urlDefine = Helpers::getRoute($route->parseStringRoute(new Request));
        if (is_array($urlDefine)) {
            // Validate controller name to prevent directory traversal
            if (!preg_match('/^[a-zA-Z0-9_]+$/', $urlDefine['controller'])) {
                throw new Exception("Invalid controller name");
            }

            $file = ROOT . "App/Controllers" . DS . $urlDefine['controller'] . ".php";
    
            if (is_readable($file)) {
                try {
                    require_once($file);
                    $class = 'App\Controllers\\' . $urlDefine['controller'];
                    
                    $instanceController = Factory::setup($class);
                    
                    $dataController = self::callMethodWithParametersFromController($instanceController, $urlDefine['action'], $route);
                   
                } catch(Exception $e) {
                    print_r($e);
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
