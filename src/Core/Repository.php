<?php

namespace App\Core;

use PDO;

abstract class Repository
{
    protected PDO $connection;

    public function __construct(Database $database)
    {
        $this->connection = $database->getConnection();
    }
}
