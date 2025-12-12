<?php

namespace Database;

use PDO;
use PDOException;

class Database 
{
    protected static $dbInstance;
    protected $connection;

    private function __construct(array $args)
    {
        $this->connection($args['dbname'], $args['user'], $args['password'], $args['host'] ?? 'localhost', $args['manager'] ?? 'mysql');
    }

    public static function getInstance(array $args = []): Database
    {
        if (self::$dbInstance === null) {
            self::$dbInstance = new self($args);
        }
        return self::$dbInstance;
    }

    public function __destruct()
    {
        $this->connection = null;
    }

    public function connection(string $dbname, string $user, string $password, string $host = 'localhost', string $manager = 'mysql'): void
    {
        try {
            $dsn = "$manager:host=$host;dbname=$dbname;charset=utf8mb4";
            $this->connection = new PDO($dsn, $user, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            error_log('Database connection error: ' . $e->getMessage());
            throw new \Exception("Database connection error: " . $e->getMessage());
        }
    }

    public function getConn(): ?PDO
    {
        return $this->connection;
    }
}
