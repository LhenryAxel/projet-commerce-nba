<?php
require_once '../core/Database.php';
require_once '../src/Models/Category.php';
require_once '../src/Models/Product.php';
require_once '../src/Models/Order.php';
require_once '../src/Models/OrderDetails.php';
require_once '../src/Models/User.php';
require_once '../src/Controllers/CategoryController.php';
require_once '../src/Controllers/ProductController.php';
require_once '../src/Controllers/OrderController.php';
require_once '../src/Controllers/UserController.php';

use Controllers\OrderController;
use Controllers\CategoryController;
use Controllers\ProductController;
use Controllers\UserController;

// Initialize controllers
$categoryController = new CategoryController();
$productController = new ProductController();
$orderController = new OrderController();
$userController = new UserController();

// Start session for user authentication
session_start();

// Get the current request URI
$requestUri = trim($_SERVER['REQUEST_URI'], '/');

// Define public and protected routes
$protectedRoutes = [
    'projet-commerce-nba/public',
    'projet-commerce-nba/public/categories',
    'projet-commerce-nba/public/products',
    'projet-commerce-nba/public/orders',
];

// Restrict access to protected routes if not logged in
if (in_array($requestUri, $protectedRoutes) && !isset($_SESSION['user'])) {
    header('Location: /projet-commerce-nba/public/login');
    exit;
}

// Route handling
switch (true) {
    // Home page route
    case $requestUri === 'projet-commerce-nba/public':
        echo "<h1>Bienvenue dans l'application NBA Store</h1>";
        echo '<a href="/projet-commerce-nba/public/categories">Gérer les catégories</a><br>';
        echo '<a href="/projet-commerce-nba/public/products">Gérer les produits</a><br>';
        echo '<a href="/projet-commerce-nba/public/orders">Gérer les commandes</a><br>';
        echo '<a href="/projet-commerce-nba/public/logout">Se déconnecter</a>';
        break;

    // Category routes
    case $requestUri === 'projet-commerce-nba/public/categories':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['id']) && !empty($_POST['id'])) {
                // Update existing category
                $id = $_POST['id'];
                $name = $_POST['name'];
                $description = $_POST['description'];
                $categoryController->update($id, $name, $description);
            } else {
                // Create new category
                $name = $_POST['name'];
                $description = $_POST['description'];
                $categoryController->create($name, $description);
            }
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
    case $requestUri === 'projet-commerce-nba/public/products':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['id']) && !empty($_POST['id'])) {
                // Update existing product
                $id = $_POST['id'];
                $name = $_POST['name'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $stock = $_POST['stock'];
                $category_id = $_POST['category_id'];
                $productController->update($id, $name, $description, $price, $stock, $category_id);
            } else {
                // Create new product
                $name = $_POST['name'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $stock = $_POST['stock'];
                $category_id = $_POST['category_id'];
                $productController->create($name, $description, $price, $stock, $category_id);
            }
        } else {
            $productController->handleRequest();
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

    case strpos($requestUri, 'projet-commerce-nba/public/products') === 0:
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle product creation
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $stock = $_POST['stock'];
            $category_id = $_POST['category_id'];
            $productController->create($name, $description, $price, $stock, $category_id);
        } else {
            // Handle product filtering or listing
            $queryParams = [];
            parse_str($_SERVER['QUERY_STRING'], $queryParams); // Parse query parameters
            $category_filter = $queryParams['category_filter'] ?? null;
            $price_min = $queryParams['price_min'] ?? null;
            $price_max = $queryParams['price_max'] ?? null;
            $productController->handleRequest($category_filter, $price_min, $price_max);
        }
        break;


    // User registration
    case $requestUri === 'projet-commerce-nba/public/register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if ($userController->register($first_name, $last_name, $email, $password)) {
                header('Location: /projet-commerce-nba/public/login');
                exit;
            } else {
                echo "Erreur lors de l'inscription.";
            }
        } else {
            require_once '../src/Views/register.php';
        }
        break;

    // User login
    case $requestUri === 'projet-commerce-nba/public/login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if ($userController->login($email, $password)) {
                header('Location: /projet-commerce-nba/public');
                exit;
            } else {
                echo "Identifiants invalides.";
            }
        } else {
            require_once '../src/Views/login.php';
        }
        break;

    // User logout
    case $requestUri === 'projet-commerce-nba/public/logout':
        $userController->logout();
        header('Location: /projet-commerce-nba/public/login');
        exit;
        break;

    default:
        echo "<h1>404 - Page non trouvée</h1>";
        break;
}
