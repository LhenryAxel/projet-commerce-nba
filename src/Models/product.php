<?php

namespace Models;

use Core\Database;
use PDO;

class Product {
    private $pdo;


    public function __construct() {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    // Fetch all products with category names
    public function getAll() {
        $stmt = $this->pdo->query("
            SELECT products.*, categories.name AS category_name 
            FROM products 
            LEFT JOIN categories ON products.category_id = categories.id
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Create a new product
    public function create($name, $description, $price, $stock, $category_id) {
        $stmt = $this->pdo->prepare("
            INSERT INTO products (name, description, price, stock, category_id) 
            VALUES (:name, :description, :price, :stock, :category_id)
        ");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Fetch a product by its ID
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update an existing product
    public function update($id, $name, $description, $price, $stock, $category_id) {
        $stmt = $this->pdo->prepare("
            UPDATE products 
            SET name = :name, description = :description, price = :price, stock = :stock, category_id = :category_id 
            WHERE id = :id
        ");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Delete a product by its ID
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM products WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getAllWithFilters($filters) {
        $query = "
            SELECT products.*, categories.name AS category_name 
            FROM products 
            LEFT JOIN categories ON products.category_id = categories.id 
            WHERE 1 = 1
        ";
    
        // Add condition dynamically
        if (!empty($filters['category_id'])) {
            $query .= " AND products.category_id = :category_id";
        }
        if (!empty($filters['price_min'])) {
            $query .= " AND products.price >= :price_min";
        }
        if (!empty($filters['price_max'])) {
            $query .= " AND products.price <= :price_max";
        }
    
        $stmt = $this->pdo->prepare($query);
    
        if (!empty($filters['category_id'])) {
            $stmt->bindParam(':category_id', $filters['category_id'], PDO::PARAM_INT);
        }
        if (!empty($filters['price_min'])) {
            $stmt->bindParam(':price_min', $filters['price_min']);
        }
        if (!empty($filters['price_max'])) {
            $stmt->bindParam(':price_max', $filters['price_max']);
        }
    
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    
}
