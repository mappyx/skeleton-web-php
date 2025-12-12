<?php
$config = [
    'name_app' => getenv('APP_NAME') ?: 'Shop Example',
    'url' => getenv('APP_URL') ?: 'http://localhost:8000/',
    'version' => '1.0',
    'db' => [
        'dbname' => getenv('DB_DATABASE') ?: 'shop_abc',
        'user' => getenv('DB_USERNAME') ?: 'desarrollo',
        'password' => getenv('DB_PASSWORD') ?: '5239424209',
        'host' => getenv('DB_HOST') ?: 'localhost',
        'manager' => getenv('DB_CONNECTION') ?: 'mysql',
    ],  
];