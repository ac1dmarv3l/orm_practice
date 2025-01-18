<?php

require_once "../vendor/autoload.php";

use ac1dmarv3l\orm_practice\DatabaseConnection;
use ac1dmarv3l\orm_practice\models\User;
use ac1dmarv3l\orm_practice\PostgresDatabase;
use ac1dmarv3l\orm_practice\QueryExecutor;
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

$pdo = $connection->connect(new PostgresDatabase($postgresConfig));

// a raw query example
$query = 'CREATE TABLE users
(
    user_id INT PRIMARY KEY,
    name VARCHAR(40) NOT NULL,
    email VARCHAR(255) NOT NULL
)';

$result = QueryExecutor::execute($pdo, $query);

if ($result === true) {
    echo 'The query successfully executed.' . PHP_EOL;
} else {
    echo $result . PHP_EOL;
}

// check if the same connection
//$pdo2 = $connection->connect(new PostgresDatabase($postgresConfig));
//var_dump($pdo === $pdo2);

// it can use different databases to initialize a connection
//$sqliteDatabase = new SqliteDatabase($sqliteConfig);
//$pdo3 = $connection->connect($sqliteDatabase);

// check if the same connection
//$pdo4 = $connection->connect($sqliteDatabase);
//var_dump($pdo3 === $pdo4);

$userMapper = new UserMapper($pdo);

// search for a user by id
//$user = $userMapper->findById(4);
//if ($user) {
//    echo $user->getId() . PHP_EOL;
//    echo $user->getName() . PHP_EOL;
//    echo $user->getEmail();
//}

// create a new user
$user = new User(null, 'Tommy', 'tommy@example.com');

$userMapper->save($user);

// check his data
if ($user->getId()) {
    echo 'A new user has been created: ' . PHP_EOL;
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
    echo 'The new user has been updated: ' . PHP_EOL;
    echo $user->getId() . PHP_EOL;
    echo $user->getName() . PHP_EOL;
    echo $user->getEmail() . PHP_EOL;
}

// delete an existing user
$userMapper->delete($user);

// the user must be removed now
if (!$user->getId()) {
    echo 'The user has been deleted' . PHP_EOL;
} else {
    // if something went wrong
    echo $user->getId() . PHP_EOL;
    echo $user->getName() . PHP_EOL;
    echo $user->getEmail() . PHP_EOL;
}