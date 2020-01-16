<?php
namespace System;

use Exception;
use System\Request;
use System\Route;
use System\Factory;

class Router
{
    public static function run(Request $request)
    {
        //Routes and get query param.
        //array 0 is query and 1 params
        $routes = new Route(true);
        $route = $routes->getRoutes();
        
        $controller = $request->getController().'Controller';
        $file = ROOT . "App/Controllers" . DS . $controller . ".php";
        
        $method = $request->getMethod();
        if ($method = 'index.php') {
            $method = 'index';
        }

        $arguments = $request->getArguments();

        if (is_readable($file)) {
            try {
                require_once($file);
                $class = 'App\Controllers\\'.$controller;
                
                $instanceController = Factory::setup($class);

                if (isset($arguments)) {
                    $dataController = call_user_func(array($instanceController,$method));
                } else {
                    $dataController = call_user_func_array(array($instanceController,$method), $arguments);
                }

            } catch(Exception $e) {
                print_r($e);
            }
        } 

        $path = ROOT . "Resources/Views" . DS . $request->getController() . DS . $request->getMethod() . '.php';

        if (is_readable($path)) {
            require_once($path);
        } else {
            //error
        }
    }
}