<?php
namespace App\Repositories;

use App\Repositories\Contracts\CustomersRepositoryInterface;

class CustomersRepository extends AbstractRepository implements CustomersRepositoryInterface
{

    public function __construct()
    {
        Parent::__construct('Customers', []);
    }

    public function __destruct()
    {
        Parent::__destruct();
    }
}