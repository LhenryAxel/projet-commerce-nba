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

    public function getAllUsers() {
        $stmt = $this->pdo->query("SELECT id, first_name, last_name, email, role, created_at FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createUser($first_name, $last_name, $email, $password_hash, $role) {
        $stmt = $this->pdo->prepare("
            INSERT INTO users (first_name, last_name, email, password_hash, role, created_at) 
            VALUES (:first_name, :last_name, :email, :password_hash, :role, NOW())
        ");
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password_hash', $password_hash);
        $stmt->bindParam(':role', $role);
        return $stmt->execute();
    }
    
    public function update($id, $data) {
        $stmt = $this->pdo->prepare("
            UPDATE users 
            SET first_name = :first_name, last_name = :last_name, email = :email, role = :role 
            WHERE id = :id
        ");
        $stmt->bindParam(':first_name', $data['first_name']);
        $stmt->bindParam(':last_name', $data['last_name']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':role', $data['role']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    

    public function deleteUser($id) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function findById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
