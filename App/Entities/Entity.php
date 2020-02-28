<?php
namespace App\Entities;

use Database\Database;
use System\Helpers;

class Entity 
{

    protected $table;
    protected $connection;
    protected $database;

    public function __construct()
    {
        $this->database = new Database(Helpers::config('db'));
        $this->connection = $this->database->getConn();
    }

    public function __destruct()
    {
        $this->database = null;
        $this->connection = null;
    }

    protected function getCurrentTime()
    {
        return date('Y-m-d H:i:s');;
    }
}
