<?php

namespace App\Repositories;

class ProductsRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct('Product', []);
    }
}
