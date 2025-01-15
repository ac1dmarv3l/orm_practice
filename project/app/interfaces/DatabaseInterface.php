<?php

namespace ac1dmarv3l\orm_practice\interfaces;

use PDO;

interface DatabaseInterface
{
    public function getConnection(): PDO;
}