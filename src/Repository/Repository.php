<?php

namespace App\Model;


abstract class Repository
{

    protected \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }
    private function query(string $sql, bool $single = true): mixed
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

    private function executeQuery(string $sql, array $datas, bool $single = true): mixed
    {
        $statement = $this->prepare($sql, $datas);

        return $single
            ? $statement->fetch(PDO::FETCH_OBJ)
            : $statement->fetchAll(PDO::FETCH_OBJ);
    }

    private function executeUpdate(string $sql, array $datas): int
    {
        return $this->prepare($sql, $datas)->rowCount();
    }

    private function insertAndGetId(string $sql, array $datas): int
    {
        $result = $this->prepare($sql, $datas)->fetch(PDO::FETCH_OBJ);

        return (int) $result->id;
    }

    private function getAllData(string $tableName): array
    {
        return $this->query("SELECT * FROM $tableName", false);
    }
}