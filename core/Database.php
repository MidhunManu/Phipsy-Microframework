<?php

namespace Core;

use PDO;
use PDOException;

class Database
{
    protected static ?PDO $connection = null;

    public static function connect()
    {
        if (self::$connection !== null) {
            return self::$connection;
        }

        $config = require __DIR__ . '/../config/database.php';

        try {
            if ($config['driver'] === 'sqlite') {
                self::$connection = new PDO("sqlite:" . $config['database']);
            }

            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return self::$connection;

        } catch (PDOException $e) {
            die("DB Connection Failed: " . $e->getMessage());
        }
    }

    public static function query(string $sql, array $params = [])
    {
        $stmt = self::connect()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
