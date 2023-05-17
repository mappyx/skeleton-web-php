<?php

namespace App\Entities;

use Database\Database;
use App\Entities\Contracts\OrderItemsInterface;

class OrderItems extends Entity implements OrderItemsInterface
{
    protected $id;
    protected $order_id;
    protected $product_id;
    protected $quantity;

    public function __construct()
    {
        $this->table = 'order_items';
        parent::__construct();
    }

    public function select(array $columns = ['*']): array
    {
        $columnName = implode(', ', $columns);
        $statement = $this->connection->prepare("SELECT $columnName FROM $this->table");
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_OBJ);
    }

    public function selectWhere(string $column, $value, array $columns = ['*']): array
    {
        $columnName = implode(', ', $columns);
        $statement = $this->connection->prepare("SELECT $columnName FROM $this->table WHERE $column = ?");
        $statement->execute([$value]);
        return $statement->fetchAll(\PDO::FETCH_OBJ);
    }

    public function delete(string $column, $value): bool
    {
        $statement = $this->connection->prepare("DELETE FROM $this->table WHERE $column = ?");
        $statement->execute([$value]);
        return $statement->rowCount() > 0;
    }

    public function insert(array $values): bool
    {
        $statement = $this->connection->prepare("
            INSERT INTO $this->table (order_id, product_id, quantity)
            VALUES (:order_id, :product_id, :quantity)
        ");
        $statement->execute($values);
        return $statement->rowCount() > 0;
    }

    public function update(array $values, $id, string $column = 'id'): bool
    {
        $statement = $this->connection->prepare("
            UPDATE $this->table SET
            order_id = :order_id, product_id = :product_id, quantity = :quantity
            WHERE $column = :id
        ");
        $values['id'] = $id;
        $statement->execute($values);
        return $statement->rowCount() > 0;
    }
}
