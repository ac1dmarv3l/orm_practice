<?php

namespace ac1dmarv3l\orm_practice;

use ac1dmarv3l\orm_practice\interfaces\DatabaseInterface;
use PDO;
use PDOException;

class PostgresDatabase implements DatabaseInterface
{
    private ?string $host;
    private ?string $port;
    private ?string $dbname;
    private ?string $username;
    private ?string $password;

    private ?PDO $connection = null;

    public function __construct($config)
    {
        $this->host = $config['host'] ?? null;
        $this->port = $config['port'] ?? null;
        $this->dbname = $config['dbname'] ?? null;
        $this->username = $config['username'] ?? null;
        $this->password = $config['password'] ?? null;
    }

    public function getConnection(): PDO
    {
        if ($this->connection === null) {
            try {
                $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->dbname}";
                $this->connection = new PDO($dsn, $this->username, $this->password);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'PostgreSQL connection error: ' . $e->getMessage();
            }
        }

        return $this->connection;
    }
}