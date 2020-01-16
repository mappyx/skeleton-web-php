<?php
namespace App\Entities;

use Database\Database;
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

    protected $table;

    public function __construct()
    {
        Parent::__construct();
        $this->table = 'products';
    }

    public function __destruct()
    {
        $this->conn = null;
    }

    public function select(array $column = ['*'])
    {
        if (count($column) == 1) $columnName = $column[0];
        if (count($column) > 1) $columnName = implode(", ", $column);
        $statement =  $this->connection->prepare("SELECT $columnName FROM $this->table");
        $statement->execute();
        $results = $statement->fetchAll(\PDO::FETCH_OBJ);
        return $results;
    }

    public function selectWhere(string $columnWhere, $value, array $column = ['*'])
    {
        if (count($column) == 1) $columnName = $column[0];
        if (count($column) > 1) $columnName = implode(", ", $column);
        $statement =  $this->connection->prepare("SELECT $columnName FROM $this->table where $columnWhere=$value");
        $statement->execute();
        $results = $statement->fetchAll(\PDO::FETCH_OBJ);
        return $results;
    }

    public function delete(string $column, $value)
    {
        if ($this->connection->exec("DELETE FROM $this->table WHERE $column=$value")) {
            return true;
        } else {
            return false;
        }
    }

    public function insert(array $args)
    {
        $statement = $this->connection->prepare("
        INSERT INTO $this->table (id, name, description, price, created, modified, status)
         VALUES (null, :name, :description, :price, :created, :modified, :status)
        ");
        $statement->bindParam(':name', $args['name']);
        $statement->bindParam(':description', $args['description']);
        $statement->bindParam(':price', $args['price']);
        $statement->bindParam(':created', $args['created']);
        $statement->bindParam(':modified', $args['modified']);
        $statement->bindParam(':status', $args['status']);
        $statement->execute();
    }

    public function update(array $args, $value, string $column = 'id')
    {
        $statement = $this->connection->prepare("
        UPDATE $this->table SET
         name=:name, description=:description, price=:price, created=:created, modified=:modified, status=:status
         where $column=:value");
        $statement->bindParam(':name', $args['name']);
        $statement->bindParam(':description', $args['description']);
        $statement->bindParam(':price', $args['price']);
        $statement->bindParam(':created', $args['created']);
        $statement->bindParam(':modified', $args['modified']);
        $statement->bindParam(':status', $args['status']);
        $statement->bindParam(':value', $value);
        $statement->execute();
    }
}