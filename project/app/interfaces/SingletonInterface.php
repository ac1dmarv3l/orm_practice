<?php

namespace ac1dmarv3l\orm_practice\interfaces;

use PDO;

interface SingletonInterface
{
    public static function getInstance(): self;

    public function connect(DatabaseInterface $database): PDO;

    public function __clone();

    public function __wakeup();
}