<?php

namespace Core;

use Core\Database;
use PDO;

abstract class Model
{
    protected string $table;

    public function all()
    {
        return Database::query("SELECT * FROM {$this->table}")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        return Database::query(
            "SELECT * FROM {$this->table} WHERE id = ? LIMIT 1",
            [$id]
        )->fetch(PDO::FETCH_ASSOC);
    }

    public function create(array $data)
    {
        $columns = array_keys($data);
        $values = array_values($data);

        $columnStr = implode(", ", $columns);
        $placeholders = implode(", ", array_fill(0, count($values), "?"));

        Database::query(
            "INSERT INTO {$this->table} ($columnStr) VALUES ($placeholders)",
            $values
        );

        return Database::connect()->lastInsertId();
    }
}
