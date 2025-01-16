<?php

require_once "../vendor/autoload.php";

use ac1dmarv3l\orm_practice\DatabaseConnection;
use ac1dmarv3l\orm_practice\models\User;
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

// check if the same connection
//$pdo2 = $connection->connect($postgresDatabase);
//var_dump($pdo1 === $pdo2);

// we can use different databases to initialize a connection
$sqliteDatabase = new SqliteDatabase($sqliteConfig);
$pdo3 = $connection->connect($sqliteDatabase);

// check if the same connection
//$pdo4 = $connection->connect($sqliteDatabase);
//var_dump($pdo3 === $pdo4);

$userMapper = new UserMapper($pdo1);

// search for a user by id
//$user = $userMapper->findById(4);
//if ($user) {
//    echo $user->getId() . PHP_EOL;
//    echo $user->getName() . PHP_EOL;
//    echo $user->getEmail();
//}

// create a new user
$user = new User(0, 'Tommy', 'tommy@example.com');

$userMapper->save($user);

// check his data
if ($user->getId()) {
    echo $user->getId() . PHP_EOL;
    echo $user->getName() . PHP_EOL;
    echo $user->getEmail() . PHP_EOL;
}

// update an existing user
$user->setName('Thomas');
$user->setEmail('thomas@example.com');

$userMapper->save($user);

// check his modified data
if ($user->getId()) {
    echo $user->getId() . PHP_EOL;
    echo $user->getName() . PHP_EOL;
    echo $user->getEmail() . PHP_EOL;
}

// delete an existing user
$userMapper->delete($user);

// the user must be removed now
if (!$user->getId()) {
    echo 'The user was not found' . PHP_EOL;
} else {
    // if something went wrong
    echo $user->getId() . PHP_EOL;
    echo $user->getName() . PHP_EOL;
    echo $user->getEmail() . PHP_EOL;
}