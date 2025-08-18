<?php

namespace Model;

require_once __DIR__ . 
'/../config/configuration.php';

use PDO;
use PDOException;

class Connection
{
    public static function getConnection()
    {
        try {
            return new PDO('mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
        } catch (PDOException $e) {
            die("Erro de conexão: " . $e->getMessage());
        }
    }
}

