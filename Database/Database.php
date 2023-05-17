<?php

namespace Database;

use PDO;
use PDOException;

class Database 
{
    protected $instance;

    public function __construct(array $args)
    {
        $this->connection($args['dbname'], $args['user'], $args['password'], $args['host'] ?? 'localhost', $args['manager'] ?? 'mysql');
    }

    public function __destruct()
    {
        $this->instance = null;
    }

    public function connection(string $dbname, string $user, string $password, string $host = 'localhost', string $manager = 'mysql'): bool
    {
        try {
            $dsn = "$manager:host=$host;dbname=$dbname;charset=utf8mb4";
            $this->instance = new PDO($dsn, $user, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
            return true;
        } catch (PDOException $e) {
            error_log('Database connection error: ' . $e->getMessage());
            $this->instance = null;
            return false;
        }
    }

    public function getConn(): ?PDO
    {
        return $this->instance;
    }
}
