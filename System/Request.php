<?php
namespace System;

class Request
{
    protected $controller;
    protected $method;
    protected $arguments;
    protected $methodHttp;

    public function __construct()
    {
        if (isset($_GET['url'])) {
            $route = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
            $route = explode('/', $route);
            $route = array_filter($route);
        }
    }
    
    public function __destruct()
    {
        
    }
}