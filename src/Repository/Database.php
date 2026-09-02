<?php

namespace App\Model;

final class Database
{
    private static ?\PDO $connection = null;

    private string $host;
    private string $dbName;
    private string $username;
    private string $password;
    private int $port;

    private function __construct()
    {
        $config = require dirname(__DIR__, 2) . '/config/database.php';

        $this->host     = $config['host'];
        $this->dbName   = $config['dbname'];
        $this->username = $config['user'];
        $this->password = $config['password'];
        $this->port     = $config['port'];
    }

    public static function getConnection(): \PDO
    {
        if (self::$connection === null) {
            self::$connection = (new self())->connect();
        }

        return self::$connection;
    }

    private function connect(): \PDO
    {
        $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->dbName}";

        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        ];

        try {
            return new \PDO($dsn, $this->username, $this->password, $options);
        } catch (\PDOException $e) {
            error_log('Erreur de connexion à la base de données : ' . $e->getMessage());
            throw $e;
        }
    }

    public static function closeConnection(): void
    {
        self::$connection = null;
    }
}