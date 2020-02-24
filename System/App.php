<?php
namespace System;

use System\Route;
use System\Router;
use Resources\Views\Template as ViewsTemplate;

class App {

    protected $database;

    public function __construct()
    {

    }

    public function __destruct()
    {
        $this->database = null;
    }

    public function run() {
        $template = new ViewsTemplate();
        Router::run(new Route(true));
    }
}