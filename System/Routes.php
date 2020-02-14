<?php
$routes = [
    '/' => [
        'controller' => 'HomeController',
        'action' => 'index',
        'view' => 'Home/index',
        'name' => 'home',
    ],
    '/products' => [
        'controller' => 'ProductsController',
        'action' => 'index',
        'view' => 'Products/index',
        'name' => 'products.index',
    ],
];