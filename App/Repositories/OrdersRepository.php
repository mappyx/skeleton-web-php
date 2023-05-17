<?php

namespace App\Repositories;

use App\Repositories\Contracts\OrdersRepositoryInterface;
use App\Entities\Orders as Entity;

class OrdersRepository extends AbstractRepository implements OrdersRepositoryInterface
{

    public function __construct()
    {
        parent::__construct('Orders', []);
    }

    public function __destruct()
    {
        parent::__destruct();
    }

}