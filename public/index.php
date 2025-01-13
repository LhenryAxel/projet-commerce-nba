<?php

require_once '../core/Database.php';
require_once '../src/Models/Category.php';
require_once '../src/Models/Product.php';
require_once '../src/Controllers/CategoryController.php';
require_once '../src/Controllers/ProductController.php';

use Controllers\CategoryController;
use Controllers\ProductController;

$categoryController = new CategoryController();
$productController = new ProductController();

$requestUri = trim($_SERVER['REQUEST_URI'], '/');


if ($requestUri === 'projet-commerce-nba/public') {
    echo "<h1>Bienvenue dans l'application NBA Store</h1>";
    echo '<a href="/projet-commerce-nba/public/categories">Gérer les catégories</a><br>';
    echo '<a href="/projet-commerce-nba/public/products">Gérer les produits</a>';
} 

elseif ($requestUri === 'projet-commerce-nba/public/categories') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $categoryController->create($name, $description);
    } else {
        $categoryController->handleRequest();
    }
} elseif (strpos($requestUri, 'projet-commerce-nba/public/categories/delete') !== false) {
    $id = $_GET['id'];
    $categoryController->delete($id);
} elseif (strpos($requestUri, 'projet-commerce-nba/public/categories/edit') !== false) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $categoryController->update($id, $name, $description);
    } else {
        $id = $_GET['id'];
        $categoryController->edit($id);
    }
} 

elseif ($requestUri === 'projet-commerce-nba/public/products') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $category_id = $_POST['category_id'];
        $productController->create($name, $description, $price, $stock, $category_id);
    } else {
        $productController->handleRequest();
    }
} elseif (strpos($requestUri, 'projet-commerce-nba/public/products/delete') !== false) {
    $id = $_GET['id'];
    $productController->delete($id);
} elseif (strpos($requestUri, 'projet-commerce-nba/public/products/edit') !== false) {
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
} elseif ($requestUri === 'projet-commerce-nba/public/products/create') {
    $categories = (new \Models\Category())->getAll();
    require_once '../src/Views/create_product.php';
} else {
    echo "<h1>404 - Page non trouvée</h1>";
}
