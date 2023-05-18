<?php

namespace App\Controllers;

use System\View;

abstract class Controller {
    
    protected $views = [];
    
    public function __construct()
    {
        
    }

    public function __destruct()
    {
        $this->views = [];
    }
    
    protected function addView(string $name, View $view) {
        $this->views[$name] = $view;
    }
    
    protected function getView(string $name) {
        return $this->views[$name];
    }
}