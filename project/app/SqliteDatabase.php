<?php

namespace ac1dmarv3l\orm_practice;

use ac1dmarv3l\orm_practice\interfaces\DatabaseInterface;
use PDO;
use PDOException;

class SqliteDatabase implements DatabaseInterface
{
    private string $db_path;

    private ?PDO $connection = null;

    public function __construct($config)
    {
        $this->db_path = $config['db_path'] ?? null;
    }

    public function getConnection(): PDO
    {
        if ($this->connection === null) {
            try {
                $this->connection = new PDO('sqlite:' . $this->db_path);
            } catch (PDOException $e) {
                echo 'SQLite connection error: ' . $e->getMessage();
            }
        }

        return $this->connection;
    }
}