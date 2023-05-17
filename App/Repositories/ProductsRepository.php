<?php

namespace App\Repositories;

use App\Repositories\Contracts\ProductsRepositoryInterface;

class ProductsRepository extends AbstractRepository implements ProductsRepositoryInterface
{

    public function __construct()
    {
        parent::__construct('Products', []);
    }

    public function __destruct()
    {
        parent::__destruct();
    }

}