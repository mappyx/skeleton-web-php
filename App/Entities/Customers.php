<?php
namespace App\Entities;

use Database\Database;

use App\Entities\Contracts\CustomersInterface;

class Customers extends Entity implements CustomersInterface
{
    protected $table;
    protected $connection;
    protected $id;
    protected $name;
    protected $email;
    protected $phone;
    protected $address;
    protected $created;
    protected $modified;
    protected $status;

    public function __construct(Database &$db)
    {
        $this->table = 'customers';
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
        INSERT INTO $this->table (id, name, email, phone, address, created, modified, status)
         VALUES (null, :name, :email, :phone, :address, :created, :modified, :status)
        ");
        $statement->bindParam(':name', $args['name']);
        $statement->bindParam(':email', $args['email']);
        $statement->bindParam(':phone', $args['phone']);
        $statement->bindParam(':address', $args['address']);
        $statement->bindParam(':created', $args['created']);
        $statement->bindParam(':modified', $args['modified']);
        $statement->bindParam(':status', $args['status']);
        $statement->execute();
    }

    public function update(array $args, $value, string $column = 'id')
    {
        $statement = $this->connection->prepare("
        UPDATE $this->table SET
         name=:name, email=:email, phone=:phone, address=:address, created=:created, modified=:modified, status=:status
         where $column=:value");
        $statement->bindParam(':name', $args['name']);
        $statement->bindParam(':email', $args['email']);
        $statement->bindParam(':phone', $args['phone']);
        $statement->bindParam(':address', $args['address']);
        $statement->bindParam(':created', $args['created']);
        $statement->bindParam(':modified', $args['modified']);
        $statement->bindParam(':status', $args['status']);
        $statement->bindParam(':value', $value);
        $statement->execute();
    }
}