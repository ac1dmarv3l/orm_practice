<?php

namespace ac1dmarv3l\orm_practice;

use ac1dmarv3l\orm_practice\interfaces\DatabaseInterface;
use ac1dmarv3l\orm_practice\interfaces\SingletonInterface;
use PDO;
use PDOException;

class DatabaseConnection implements SingletonInterface
{
    private static ?self $instance = null;
    private ?DatabaseInterface $database = null;
    private ?PDO $connection = null;

    protected function __construct() {}

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function connect(DatabaseInterface $database): PDO
    {
        if ($this->database !== $database) {
            $this->database = $database;
            $this->connection = $database->getConnection();
        }

        return $this->connection;
    }

    final public function __clone() {}

    final public function __wakeup() {}
}
