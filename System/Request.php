<?php
namespace System;

use System\Contracts\RequestInterface;
use System\Contracts\RouteInterface as Route;
use ReflectionParameter;
use ReflectionMethod;

class Request implements RequestInterface
{

    protected $route;

    public function __construct(Route $route)
    {
        $this->route = $route;
        $p = new ReflectionParameter(array('Some_Class', 'someMethod'));
    }
    
    public function __destruct()
    {
        
    }
}