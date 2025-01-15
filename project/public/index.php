<?php

require_once "../vendor/autoload.php";

use ac1dmarv3l\orm_practice\DatabaseConnection;
use ac1dmarv3l\orm_practice\PostgresDatabase;
use ac1dmarv3l\orm_practice\SqliteDatabase;
use ac1dmarv3l\orm_practice\UserMapper;

$postgresConfig = [
    'host' => $_ENV['POSTGRES_HOST'],
    'port' => $_ENV['POSTGRES_PORT'],
    'dbname' => $_ENV['POSTGRES_DB'],
    'username' => $_ENV['POSTGRES_USER'],
    'password' => $_ENV['POSTGRES_PASSWORD'],
];

$sqliteConfig = [
    'db_path' => '../sqlite/sqlite.db',
];

$connection = DatabaseConnection::getInstance();

$postgresDatabase = new PostgresDatabase($postgresConfig);

$pdo1 = $connection->connect($postgresDatabase);
$pdo2 = $connection->connect($postgresDatabase);
// check if the same connection
//var_dump($pdo1 === $pdo2);

$sqliteDatabase = new SqliteDatabase($sqliteConfig);
$pdo3 = $connection->connect($sqliteDatabase);
$pdo4 = $connection->connect($sqliteDatabase);
// check if the same connection
//var_dump($pdo3 === $pdo4);

$userMapper = new UserMapper($pdo1);
$user = $userMapper->findById(2);
if ($user) {
    print_r($user);
}