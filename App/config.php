<?php
// Validate required environment variables
$requiredEnvVars = ['APP_NAME', 'APP_URL', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD', 'DB_HOST'];
foreach ($requiredEnvVars as $var) {
    if (!getenv($var)) {
        throw new Exception("Required environment variable $var is not set");
    }
}

$config = [
    'name_app' => getenv('APP_NAME'),
    'url' => getenv('APP_URL'),
    'version' => '1.0',
    'db' => [
        'dbname' => getenv('DB_DATABASE'),
        'user' => getenv('DB_USERNAME'),
        'password' => getenv('DB_PASSWORD'),
        'host' => getenv('DB_HOST'),
        'manager' => getenv('DB_CONNECTION') ?: 'mysql',
    ],  
];