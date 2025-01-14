<?php

namespace Models;

use Core\Database;
use PDO;

class OrderDetails {
    private $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    // Fetch all details of an order
    public function getByOrderId($order_id) {
        $stmt = $this->pdo->prepare("
            SELECT order_details.*, products.name AS product_name
            FROM order_details
            LEFT JOIN products ON order_details.product_id = products.id
            WHERE order_details.order_id = :order_id
        ");
        $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Add a product to an order
    public function create($order_id, $product_id, $quantity, $price) {
        $stmt = $this->pdo->prepare("
            INSERT INTO order_details (order_id, product_id, quantity, price) 
            VALUES (:order_id, :product_id, :quantity, :price)
        ");
        $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':price', $price);
        return $stmt->execute();
    }
    
}
