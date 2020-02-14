<?php
namespace System;

class Route {

    private $basepath;
    private $uri;
    private $base_url;
    private $routes;
    private $route;
    private $params;
    private $get_params;

    function __construct($get_params = false) {
        $this->get_params = $get_params;
    }

    public function getRoutes()
    {
        $this->base_url = $this->getCurrentUri();
        $this->routes = explode('/', $this->base_url);

        $this->getParams();
        return $this->routes;
    }

    public function parseStringRoute(): string
    {
        $this->base_url = $this->getCurrentUri();
        
        $route = $this->base_url;
        return $route;
    }

    private function getCurrentUri()
    {
        $this->basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
        $this->uri = substr($_SERVER['REQUEST_URI'], strlen($this->basepath));

        if($this->get_params) {
            $this->getParams();
        } else {
            if (strstr($this->uri, '?')) $this->uri = substr($this->uri, 0, strpos($this->uri, '?'));
        }

        $this->uri = '/' . trim($this->uri, '/');
        return $this->uri;
    }

    private function getParams()
    {
        if (strstr($this->uri, '?')) {
            $params = explode("?", $this->uri);
            $params = $params[1];

            parse_str($params, $this->params);
            $this->routes[0] = $this->params;
            array_pop($this->routes);
        }
    }
}