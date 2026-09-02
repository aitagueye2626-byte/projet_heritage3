<?php

return [
    'host'     => $_ENV['DB_HOST'] ?? 'localhost',
    'port'     => (int) ($_ENV['DB_PORT'] ?? 5432),
    'dbname'   => $_ENV['DB_NAME'] ?? 'notation_universitaire',
    'user'     => $_ENV['DB_USER'] ?? 'postgres',
    'password' => $_ENV['DB_PASSWORD'] ?? 'default',
];