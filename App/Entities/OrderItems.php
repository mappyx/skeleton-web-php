<?php
namespace App\Entities;

use Database\Database;

class OrderItems {
    protected $id;
    protected $order_id;
    protected $product_id;
    protected $quantity;

    protected $table;
    protected $connection;

    public function __construct(Database &$db)
    {
        $this->table = 'order_items';
        $this->connection = $db->getConn();
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
        INSERT INTO $this->table (id, order_id, product_id, quantity)
         VALUES (null, :order_id, :product_id, :quantity)
        ");
        $statement->bindParam(':order_id', $args['order_id']);
        $statement->bindParam(':product_id', $args['product_id']);
        $statement->bindParam(':quantity', $args['quantity']);
        $statement->execute();
    }

    public function update(array $args, $value, string $column = 'id')
    {
        $statement = $this->connection->prepare("
        UPDATE $this->table SET
        order_id=:order_id, product_id=:product_id, quantity=:quantity
         where $column=:value");
        $statement->bindParam(':order_id', $args['order_id']);
        $statement->bindParam(':product_id', $args['product_id']);
        $statement->bindParam(':quantity', $args['quantity']);
        $statement->bindParam(':value', $value);
        $statement->execute();
    }
}