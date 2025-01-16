<?php

namespace Controllers;

use Models\Product;
use Models\Category;

class ProductController {
    private $model;
    private $categoryModel;

    // Initialize Product and Category models
    public function __construct() {
        $this->model = new Product();
        $this->categoryModel = new Category();
    }

    // Handle product list request and load the view
    public function handleRequest($category_filter = null, $price_min = null, $price_max = null) {
        $categories = $this->categoryModel->getAll();
    
        $filters = [
            'category_id' => $category_filter,
            'price_min' => $price_min,
            'price_max' => $price_max,
        ];
        $products = $this->model->getAllWithFilters($filters);
    
        require_once '../src/Views/products.php';
    }

    // Create a new product and redirect to the list
    public function create($name, $description, $price, $stock, $category_id, $image) {
        // Handle image upload
        $imagePath = $this->uploadImage($image);

        // Pass the image path to the model
        if ($this->model->create($name, $description, $price, $stock, $category_id, $imagePath)) {
            header('Location: /projet-commerce-nba/public/products');
            exit;
        } else {
            echo "Erreur lors de l'ajout du produit.";
        }
    }

    // Load the edit form with product and category data
    public function edit($id) {
        $product = $this->model->getById($id);
        $categories = $this->categoryModel->getAll();
        require_once '../src/Views/edit_product.php';
    }

    public function update($id, $name, $description, $price, $stock, $category_id, $image) {
        // Handle image upload
        $imagePath = $this->uploadImage($image);
    
        // Update the product with the new image path
        if ($this->model->update($id, $name, $description, $price, $stock, $category_id, $imagePath)) {
            header('Location: /projet-commerce-nba/public/products');
            exit;
        } else {
            echo "Erreur lors de la mise à jour du produit.";
        }
    }    

    // Delete a product and redirect to the list
    public function delete($id) {
        if ($this->model->delete($id)) {
            header('Location: /projet-commerce-nba/public/products');
            exit;
        } else {
            echo "Erreur lors de la suppression du produit.";
        }
    }

    // Handle image upload
    private function uploadImage($image) {
        // Ensure the uploads directory exists
        $targetDir = realpath(__DIR__ . '/../../public/uploads');
        if (!$targetDir) {
            mkdir(__DIR__ . '/../../public/uploads', 0755, true);
            $targetDir = realpath(__DIR__ . '/../../public/uploads');
        }

        $imagePath = null;

        if (!empty($image['name'])) {
            $targetFile = $targetDir . '/' . basename($image['name']);
            $webPath = '/uploads/' . basename($image['name']); // Relative path for database

            if (move_uploaded_file($image['tmp_name'], $targetFile)) {
                $imagePath = $webPath;
            }
        }

        return $imagePath;
    }

    public function handleClientRequest() {
        $products = $this->model->getAll(); // Fetch all products
        require_once '../src/Views/product_client.php'; // Load client view
    }    
}
