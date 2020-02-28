<?php
namespace App\Controllers;

use App\Repositories\ProductsRepository;

class ProductsController extends Controller
{
    public function __construct()
    {
        
    }

    public function __destruct()
    {
        
    }

    public function index()
    {
        $products = new ProductsRepository();
        return $products->getAllRecord();
    }
}