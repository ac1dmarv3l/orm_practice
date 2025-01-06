<?php

// Database connection settings
$host = 'postgres';  // or the IP address of your database server
$port = '5432';       // default PostgreSQL port
$dbname = 'my_database';
$username = 'my_user';
$password = 'my_password';

try {
    // Create a PDO instance
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $username, $password);

    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected to the database successfully!";
} catch (PDOException $e) {
    // Handle any connection errors
    echo "Connection failed: " . $e->getMessage();
}

// Output PHP configuration and environment information
//phpinfo();