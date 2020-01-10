<?php
namespace Database;

class Database {

    protected $instance;

    public function __construct(array $args)
    {
        $this->connection($args['dbname'], $args['user'], $args['password'], $args['host'] = 'localhost', $args['manager'] = 'mysql');
    }

    public function __destruct()
    {
        $this->instance = null;
    }

    public function connection(string $dbname, string $user, string $password, string $host, string $manager)
    {
        try {
            $dsn = "$manager:host=$host;dbname=$dbname";
            $this->instance = new \PDO($dsn, $user, $password);
            return true;
        } catch (\PDOException $e){
            //echo $e->getMessage();
            $this->instance = null;
            return false;
        }
    }

    public function getConn()
    {
        return $this->instance;
    }
}