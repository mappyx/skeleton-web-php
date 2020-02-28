<?php
namespace System;

use System\Contracts\RouteInterface;

class Route implements RouteInterface
{
    private $route;

    private $get_params;

    function __construct(bool $get_params = true)
    {
        $this->get_params = $get_params;
    }

    public function getRoutes(): array
    {
        $base_url = $this->getCurrentUri();
        $this->route = explode('/', $base_url);
        return $this->route;
    }

    public function parseStringRoute(): string
    {
        $route = $this->getCurrentUri();
        return $route;
    }

    private function getCurrentUri(): string
    {
        $basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
        
        $uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
        
        if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));

        $uri = '/' . trim($uri, '/');

        return $uri;
    }

    public function getParamsFromUrl(): array
    {
        $basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
        $uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
        //$uri = substr($uri, 0, strpos($uri, '?'));
        
        if (strstr($uri, '?')) {
            $params = explode("?", $uri);
            $params = $params[1];

            parse_str($params, $params);
        }
        return $params ?? [];
    }
}