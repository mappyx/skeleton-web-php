<?php

namespace App\Entities;

use Database\Database;
use App\Entities\Contracts\OrdersInterface;

class Orders extends Entity implements OrdersInterface
{
    protected $id;
    protected $customer_id;
    protected $total_price;
    protected $created;
    protected $modified;
    protected $status;

    public function __construct()
    {
        $this->table = 'orders';
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
            INSERT INTO $this->table (customer_id, total_price, created, modified, status)
            VALUES (:customer_id, :total_price, :created, :modified, :status)
        ");
        $statement->execute($values);
        return $statement->rowCount() > 0;
    }

    public function update(array $values, $id, string $column = 'id'): bool
    {
        $statement = $this->connection->prepare("
            UPDATE $this->table SET
            customer_id = :customer_id, total_price = :total_price, created = :created, modified = :modified, status = :status
            WHERE $column = :id
        ");
        $values['id'] = $id;
        $statement->execute($values);
        return $statement->rowCount() > 0;
    }
}
