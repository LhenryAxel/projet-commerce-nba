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
    public function handleRequest() {
        $categories = (new \Models\Category())->getAll(); 
        $products = $this->model->getAll(); 
        require_once '../src/Views/products.php';
    }
    
    // Create a new product and redirect to the list
    public function create($name, $description, $price, $stock, $category_id) {
        if ($this->model->create($name, $description, $price, $stock, $category_id)) {
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

    // Update an existing product and redirect to the list
    public function update($id, $name, $description, $price, $stock, $category_id) {
        if ($this->model->update($id, $name, $description, $price, $stock, $category_id)) {
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
}
