<?php

namespace Models;

use Core\Database;
use PDO;

class Order {
    private $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    // Fetch all orders with user and total details
    public function getAll() {
        $stmt = $this->pdo->query("
            SELECT orders.id, orders.created_at, orders.status, 
                   users.first_name AS user_first_name, users.last_name AS user_last_name
            FROM orders
            LEFT JOIN users ON orders.user_id = users.id
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    // Fetch order details by ID
    public function getById($id) {
        $stmt = $this->pdo->prepare("
            SELECT orders.*, users.name AS user_name
            FROM orders
            LEFT JOIN users ON orders.user_id = users.id
            WHERE orders.id = :id
        ");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Create a new order
    public function create($user_id, $total) {
        $stmt = $this->pdo->prepare("
            INSERT INTO orders (user_id, total, status, created_at)
            VALUES (:user_id, :total, 'pending', NOW())
        ");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':total', $total);
        $stmt->execute();
        return $this->pdo->lastInsertId(); // Retourne l'ID de la commande
    }
    

    // Update an existing order
    public function update($id, $status) {
        $stmt = $this->pdo->prepare("
            UPDATE orders 
            SET status = :status 
            WHERE id = :id
        ");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }

    // Delete an order
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM orders WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function calculateTotalSales($user_id = null, $start_date = null, $end_date = null) {
        $query = "
            SELECT SUM(order_details.quantity * order_details.price) AS total_sales
            FROM orders
            LEFT JOIN order_details ON orders.id = order_details.order_id
            WHERE 1 = 1
        ";
    
        if ($user_id) {
            $query .= " AND orders.user_id = :user_id";
        }
        if ($start_date && $end_date) {
            $query .= " AND orders.created_at BETWEEN :start_date AND :end_date";
        }
    
        $stmt = $this->pdo->prepare($query);
    
        if ($user_id) {
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        }
        if ($start_date && $end_date) {
            $stmt->bindParam(':start_date', $start_date);
            $stmt->bindParam(':end_date', $end_date);
        }
    
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total_sales'];
    }    
}
