<?php

namespace Models;

use Core\Database;
use PDO;

class User {
    private $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    public function register($first_name, $last_name, $email, $password_hash) {
        $stmt = $this->pdo->prepare("
            INSERT INTO users (first_name, last_name, email, password_hash, role, created_at) 
            VALUES (:first_name, :last_name, :email, :password_hash, 'client', NOW())
        ");
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password_hash', $password_hash);
        return $stmt->execute();
    }

    public function findByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
