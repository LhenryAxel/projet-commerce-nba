<?php

namespace Core;

use PDO;
use PDOException;

class Database {
    private $pdo;

    public function __construct() {
        // Load .env
        $env = $this->loadEnv(__DIR__ . '/../.env'); 
       
        $host = $env['DB_HOST'] ?? 'localhost';
        $db = $env['DB_DATABASE'] ?? 'test';
        $user = $env['DB_USERNAME'] ?? 'root';
        $pass = $env['DB_PASSWORD'] ?? '';
        $charset = $env['DB_CHARSET'] ?? 'utf8mb4';

        // Configuration DSN
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        try {
            $this->pdo = new PDO($dsn, $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }

    private function loadEnv($filePath) {
        if (!file_exists($filePath)) {
            die("The .env file was not found at: $filePath");
        }
    
        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $env = [];
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) continue;
            [$key, $value] = explode('=', $line, 2);
            $env[trim($key)] = trim($value);
        }
        return $env;
    }     
}
