<?php

namespace App\Container;


class Database
{
    private static ?Database $instance = null;
    private \PDO $connection;

    private function __construct()
    {
        $config = require dirname(__DIR__, 2) . '/config/database.php';

        $dsn = sprintf(
            'pgsql:host=%s;port=%d;dbname=%s',
            $config['host'],
            $config['port'],
            $config['dbname']
        );

        try {
            $this->connection = new PDO(
                $dsn,
                $config['user'],
                $config['password']
            );

            $this->connection->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        } catch (\PDOException $e) {
            error_log('Connexion PostgreSQL échouée : ' . $e->getMessage());
            throw $e;
        }
    }

    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }

    public function query(string $sql, bool $single = true): mixed
    {
        $query = $this->connection->query($sql);

        return $single
            ? $query->fetch(PDO::FETCH_OBJ)
            : $query->fetchAll(PDO::FETCH_OBJ);
    }

    private function prepare(string $sql, array $datas): \PDOStatement
    {
        $prepare = $this->connection->prepare($sql);
        $prepare->execute($datas);

        return $prepare;
    }

    public function executeQuery(string $sql, array $datas, bool $single = true): mixed
    {
        $statement = $this->prepare($sql, $datas);

        return $single
            ? $statement->fetch(PDO::FETCH_OBJ)
            : $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function executeUpdate(string $sql, array $datas): int
    {
        return $this->prepare($sql, $datas)->rowCount();
    }

    public function insertAndGetId(string $sql, array $datas): int
    {
        $result = $this->prepare($sql, $datas)->fetch(PDO::FETCH_OBJ);

        return (int) $result->id;
    }

    public function getAllData(string $tableName): array
    {
        return $this->query("SELECT * FROM $tableName", false);
    }
}