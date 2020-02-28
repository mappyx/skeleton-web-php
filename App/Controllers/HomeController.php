<?php
namespace App\Controllers;

use App\Repositories\ProductsRepository;
use Database\Database;

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

    public function index($opt = null)
    {
        return 'hola';
    }
}