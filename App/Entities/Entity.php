<?php
namespace App\Entities;

use Database\Database;
use System\Helpers;

class Entity
{
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
    }
}