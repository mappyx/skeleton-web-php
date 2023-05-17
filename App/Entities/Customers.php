<?php

namespace App\Entities;

use App\Entities\Contracts\CustomersInterface;

class Customers extends Entity implements CustomersInterface
{
    protected $id;
    protected $name;
    protected $email;
    protected $phone;
    protected $address;
    protected $created;
    protected $modified;
    protected $status;

    public function __construct()
    {
        $this->table = 'customers';
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
            INSERT INTO $this->table (name, email, phone, address, created, modified, status)
            VALUES (:name, :email, :phone, :address, :created, :modified, :status)
        ");
        $values['created'] = $this->getCurrentTime();
        $values['modified'] = $this->getCurrentTime();
        $statement->execute($values);
        return $statement->rowCount() > 0;
    }

    public function update(array $values, $id, string $column = 'id'): bool
    {
        $statement = $this->connection->prepare("
            UPDATE $this->table SET
            name = :name, email = :email, phone = :phone, address = :address, modified = :modified, status = :status
            WHERE $column = :id
        ");
        $values['modified'] = $this->getCurrentTime();
        $values['id'] = $id;
        $statement->execute($values);
        return $statement->rowCount() > 0;
    }
}