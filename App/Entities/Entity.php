<?php

namespace App\Entities;

use Database\Database;
use System\Helpers;

use App\Entities\Contracts\BasicActionEntityInterface;
use PDO;

class Entity implements BasicActionEntityInterface
{
    protected $table;
    protected $connection;
    protected $database;

    public function __construct()
    {
        $this->database = Database::getInstance(Helpers::config('db'));
        $this->connection = $this->database->getConn();
    }

    public function __destruct()
    {
        $this->database = null;
        $this->connection = null;
    }

    protected function getCurrentTime(): string
    {
        return date('Y-m-d H:i:s');
    }

    public function select(array $columns = ['*']): array
    {
        $cols = implode(', ', $columns);
        $stmt = $this->connection->prepare("SELECT $cols FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function selectWhere(string $column, $value, array $columns = ['*']): array
    {
        $cols = implode(', ', $columns);
        $stmt = $this->connection->prepare("SELECT $cols FROM {$this->table} WHERE $column = :value");
        $stmt->bindParam(':value', $value);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function delete(string $column, $value): bool
    {
        $stmt = $this->connection->prepare("DELETE FROM {$this->table} WHERE $column = :value");
        $stmt->bindParam(':value', $value);
        return $stmt->execute();
    }

    public function insert(array $values): bool
    {
        $columns = implode(', ', array_keys($values));
        $placeholders = ':' . implode(', :', array_keys($values));
        
        $stmt = $this->connection->prepare("INSERT INTO {$this->table} ($columns) VALUES ($placeholders)");
        
        foreach ($values as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        
        return $stmt->execute();
    }

    public function update(array $values, $id, string $column = 'id'): bool
    {
        $sets = [];
        foreach (array_keys($values) as $key) {
            $sets[] = "$key = :$key";
        }
        $setStr = implode(', ', $sets);
        
        $stmt = $this->connection->prepare("UPDATE {$this->table} SET $setStr WHERE $column = :id");
        
        $stmt->bindValue(':id', $id);
        foreach ($values as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        
        return $stmt->execute();
    }
}
