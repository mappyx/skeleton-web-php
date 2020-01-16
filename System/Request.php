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
            $this->methodHttp = $_GET['url'];
            $this->controller = strtolower(array_shift($route));
            $this->method = strtolower(array_shift($route));
            if ($this->method) {
                $this->method = 'index';
            }
            $this->arguments = $route;
        } else {
            $this->controller = 'Home';
            $this->methodHttp = 'get';
            $this->method = 'index';
            $this->arguments = '';
        }
    }
    
    public function __destruct()
    {
        
    }

    public function getMethodHttp()
    {
        return $this->methodHttp;
    }
    public function getController()
    {
        return $this->controller;
    }
    
    public function getMethod()
    {
        return $this->method;
    }

    public function getArguments()
    {
        return $this->arguments;
    }

}