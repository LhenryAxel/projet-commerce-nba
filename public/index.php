<?php

require_once '../core/Database.php';
require_once '../src/Models/Category.php';
require_once '../src/Models/Product.php';
require_once '../src/Controllers/CategoryController.php';
require_once '../src/Controllers/ProductController.php';

use Controllers\CategoryController;
use Controllers\ProductController;

// Initialize controllers
$categoryController = new CategoryController();
$productController = new ProductController();

// Get the current request URI
$requestUri = trim($_SERVER['REQUEST_URI'], '/');

// Route handling
switch (true) {
    // Home page route
    case $requestUri === 'projet-commerce-nba/public':
        echo "<h1>Bienvenue dans l'application NBA Store</h1>";
        echo '<a href="/projet-commerce-nba/public/categories">Gérer les catégories</a><br>';
        echo '<a href="/projet-commerce-nba/public/products">Gérer les produits</a>';
        break;

    // Category routes
    case $requestUri === 'projet-commerce-nba/public/categories':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $categoryController->create($name, $description);
        } else {
            $categoryController->handleRequest();
        }
        break;

    case strpos($requestUri, 'projet-commerce-nba/public/categories/delete') !== false:
        $id = $_GET['id'];
        $categoryController->delete($id);
        break;

    case strpos($requestUri, 'projet-commerce-nba/public/categories/edit') !== false:
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $categoryController->update($id, $name, $description);
        } else {
            $id = $_GET['id'];
            $categoryController->edit($id);
        }
        break;

    // Product routes
    case strpos($requestUri, 'projet-commerce-nba/public/products') !== false:
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $stock = $_POST['stock'];
            $category_id = $_POST['category_id'];
            $productController->create($name, $description, $price, $stock, $category_id);
        } else {
            $category_filter = $_GET['category_filter'] ?? null;
            $price_min = $_GET['price_min'] ?? null;
            $price_max = $_GET['price_max'] ?? null;
            $productController->handleRequest($category_filter, $price_min, $price_max);
        }
        break;

    case strpos($requestUri, 'projet-commerce-nba/public/products/delete') !== false:
        $id = $_GET['id'];
        $productController->delete($id);
        break;

    case strpos($requestUri, 'projet-commerce-nba/public/products/edit') !== false:
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $stock = $_POST['stock'];
            $category_id = $_POST['category_id'];
            $productController->update($id, $name, $description, $price, $stock, $category_id);
        } else {
            $id = $_GET['id'];
            $productController->edit($id);
        }
        break;

    default:
        echo "<h1>404 - Page non trouvée</h1>";
        break;
}

