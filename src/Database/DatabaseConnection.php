<?php

namespace App\Database;

use PDO;
use PDOException;

class DatabaseConnection
{
    public static function createConnection(): PDO
    {
        try {
            $pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Conexão com o banco de dados falhou erro: ' . $e->getMessage();
            die();
        }
        return $pdo;
    }
}