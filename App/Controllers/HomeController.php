<?php
namespace App\Controllers;

use App\Repositories\ProductsRepository;

class HomeController extends Controller
{
    protected $products;

    public function __construct()
    {
        $this->products = new ProductsRepository();
    }

    public function __destruct()
    {
        
    }

    public function index()
    {
        return ['message' => 'hola', 'products' => [1,2,3]];
    }
}