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

    public function __construct(Database &$db)
    {
        $this->table = 'orders';
        Parent::__construct();
    }

    public function __destruct()
    {
        Parent::__destruct();
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
        INSERT INTO $this->table (id, customer_id, total_price, created, modified, status)
         VALUES (null, :customer_id, :total_price, :created, :modified, :status)
        ");
        $statement->bindParam(':customer_id', $args['customer_id']);
        $statement->bindParam(':total_price', $args['total_price']);
        $statement->bindParam(':created', $args['created']);
        $statement->bindParam(':modified', $args['modified']);
        $statement->bindParam(':status', $args['status']);
        $statement->execute();
    }

    public function update(array $args, $value, string $column = 'id')
    {
        $statement = $this->connection->prepare("
        UPDATE $this->table SET
         customer_id=:customer_id, total_price=:total_price, created=:created, modified=:modified, status=:status
         where $column=:value");
        $statement->bindParam(':customer_id', $args['customer_id']);
        $statement->bindParam(':total_price', $args['total_price']);
        $statement->bindParam(':created', $args['created']);
        $statement->bindParam(':modified', $args['modified']);
        $statement->bindParam(':status', $args['status']);
        $statement->bindParam(':value', $value);
        $statement->execute();
    }
}