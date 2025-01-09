<?php

namespace Core;

use PDO;
use PDOException;

class Database {
    private $host = 'localhost'; 
    private $db = 'nba_store';   
    private $user = 'root';      
    private $pass = '';          
    private $charset = 'utf8mb4'; 
    private $pdo;

    public function __construct() {
        $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";

        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }
}
