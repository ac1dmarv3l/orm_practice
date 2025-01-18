<?php

namespace ac1dmarv3l\orm_practice;

use PDO;
use PDOException;

class QueryExecutor
{
    /**
     * @param PDO $connection
     * @param string $sql
     * @return bool|string
     */
    public static function execute(PDO $connection, string $sql): bool|string
    {
        try {
            $connection->query($sql);
        } catch (PDOException $e) {
            return 'The query could not be executed: ' . $e->getMessage();
        }

        return true;
    }
}