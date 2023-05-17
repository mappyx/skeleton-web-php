<?php

namespace App\Repositories;

use App\Repositories\Contracts\CustomersRepositoryInterface;

class CustomersRepository extends AbstractRepository implements CustomersRepositoryInterface
{

    public function __construct()
    {
        parent::__construct('Customers', []);
    }

    public function __destruct()
    {
        parent::__destruct();
    }
}
