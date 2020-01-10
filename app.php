<?php

use Database\Database;
use Helpers;

class App {

    protected $database;

    public function __construct()
    {
        $this->database = new Database(Helpers::config('db'));
    }

    public function __destruct()
    {
        $this->database = null;
    }

    public function run() {

    }
}