<?php

namespace App\Entities;

use App\Entities\Contracts\ProductsInterface;

class Products extends Entity implements ProductsInterface
{
    protected $id;
    protected $name;
    protected $description;
    protected $price;
    protected $created;
    protected $modified;
    protected $status;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'products';
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
            INSERT INTO $this->table (name, description, price, created, modified, status)
            VALUES (:name, :description, :price, :created, :modified, :status)
        ");
        $statement->execute($values);
        return $statement->rowCount() > 0;
    }

    public function update(array $values, $id, string $column = 'id'): bool
    {
        $statement = $this->connection->prepare("
            UPDATE $this->table SET
            name = :name, description = :description, price = :price, created = :created, modified = :modified, status = :status
            WHERE $column = :id
        ");
        $values['id'] = $id;
        $statement->execute($values);
        return $statement->rowCount() > 0;
    }
}
