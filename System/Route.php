<?php

namespace System;

use System\Contracts\RouteInterface;
use System\Contracts\RequestInterface;

class Route implements RouteInterface
{
    private $route;

    public function __construct()
    {
    }

    public function getRoutes(RequestInterface $request): array
    {
        $base_url = $request->getUri();
        $this->route = explode('/', $base_url);
        return $this->route;
    }

    public function parseStringRoute(RequestInterface $request): string
    {
        return $request->getUri();
    }

    public function getParamsFromUrl(RequestInterface $request): array
    {
        $params = $request->getParams();
        return $params;
    }
}