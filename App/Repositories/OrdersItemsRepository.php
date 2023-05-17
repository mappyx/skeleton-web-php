<?php

namespace App\Repositories;

use App\Repositories\Contracts\OrdersItemsRepositoryInterface;

class OrdersItemsRepository extends AbstractRepository implements OrdersItemsRepositoryInterface
{

    public function __construct()
    {
        parent::__construct('OrderItems', []);
    }

    public function __destruct()
    {
        parent::__destruct();
    }
}