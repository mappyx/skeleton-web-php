<?php
namespace App\Repositories;

use App\Repositories\Contracts\OrdersItemsRepositoryInterface;

class OrdersItemsRepository extends AbstractRepository implements OrdersItemsRepositoryInterface
{

    public function __construct()
    {
        Parent::__construct('OrderItems', []);
    }

    public function __destruct()
    {
        Parent::__destruct();
    }
}