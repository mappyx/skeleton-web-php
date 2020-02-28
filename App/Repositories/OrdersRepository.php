<?php
namespace App\Repositories;

use App\Repositories\Contracts\OrdersRepositoryInterface;
use App\Entities\Orders as Entity;

class OrdersRepository extends AbstractRepository implements OrdersRepositoryInterface
{

    public function __construct()
    {
        Parent::__construct('Orders', []);
    }

    public function __destruct()
    {
        Parent::__destruct();
    }

}