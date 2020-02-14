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
        $routes = new Route(true);
        $routeInString = $routes->parseStringRoute();
        $urlDefine = Helpers::getRoute($routeInString);

        if (is_array($urlDefine)) {
            $file = ROOT . "App/Controllers" . DS . $urlDefine['controller'] . ".php";
            $method = $request->getMethod();
            if ($method = 'index.php') {
                $method = 'index';
            }
            $arguments = $request->getArguments();
    
            if (is_readable($file)) {
                try {
                    require_once($file);
                    $class = 'App\Controllers\\' . $urlDefine['controller'];
                    
                    $instanceController = Factory::setup($class);
    
                    if (isset($arguments)) {
                        $dataController = call_user_func(array($instanceController,$urlDefine['action']));
                    } else {
                        $dataController = call_user_func_array(array($instanceController,$urlDefine['action']), $arguments);
                    }
    
                } catch(Exception $e) {
                    print_r($e);
                }
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
}