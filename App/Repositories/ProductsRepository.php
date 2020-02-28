<?php
namespace App\Repositories;

use App\Repositories\Contracts\ProductsRepositoryInterface;

class ProductsRepository extends AbstractRepository implements ProductsRepositoryInterface
{

    public function __construct()
    {
        Parent::__construct('Products', []);
    }

    public function __destruct()
    {
        Parent::__destruct();
    }

}