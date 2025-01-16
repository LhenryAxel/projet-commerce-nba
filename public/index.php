<?php
require_once '../core/Database.php';
require_once '../core/MongoDBConnection.php';
require_once '../src/Models/Category.php';
require_once '../src/Models/Product.php';
require_once '../src/Models/User.php';
require_once '../src/Models/Article.php';
require_once '../src/Controllers/CategoryController.php';
require_once '../src/Controllers/ProductController.php';
require_once '../src/Controllers/UserController.php';
require_once '../src/Controllers/ArticleController.php';

use Controllers\CategoryController;
use Controllers\ProductController;
use Controllers\UserController;
use Controllers\ArticleController;

// Initialize controllers
$categoryController = new CategoryController();
$productController = new ProductController();
$userController = new UserController();
$articleController = new ArticleController();

// Start session for user authentication
session_start();

// Get the current request URI
$requestUri = trim($_SERVER['REQUEST_URI'], '/');

// Define protected routes
$protectedRoutes = [
    'projet-commerce-nba/public',
    'projet-commerce-nba/public/categories',
    'projet-commerce-nba/public/products',
    'projet-commerce-nba/public/orders',
    'projet-commerce-nba/public/users',
];

// Determine the user role if logged in
$role = isset($_SESSION['user']) ? $_SESSION['user']['role'] : null;

// Redirect unauthorized users to login page
if (in_array($requestUri, $protectedRoutes) && !isset($_SESSION['user'])) {
    header('Location: /projet-commerce-nba/public/login');
    exit;
}

// Route handling
switch (true) {
    // Admin Dashboard
    case $requestUri === 'projet-commerce-nba/public':
        if ($role !== 'admin') {
            header('Location: /projet-commerce-nba/public/product_client');
            exit;
        }
        require_once '../src/Views/dashboard_admin.php';
        break;
    

    // Client Product Page
    case $requestUri === 'projet-commerce-nba/public/product_client':
        if ($role !== 'client' && $role !== 'admin') {
            header('Location: /projet-commerce-nba/public/login');
            exit;
        }
        $productController->handleClientRequest(); // Call a method to display client-facing products
        break;

    // Category routes (admin-only)
    case $requestUri === 'projet-commerce-nba/public/categories':
        if ($role !== 'admin') {
            header('Location: /projet-commerce-nba/public/product_client');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $description = $_POST['description'];
                $categoryController->update($id, $name, $description);
            } else {
                $name = $_POST['name'];
                $description = $_POST['description'];
                $categoryController->create($name, $description);
            }
        } else {
            $categoryController->handleRequest();
        }
        break;

    case strpos($requestUri, 'projet-commerce-nba/public/categories/delete') !== false:
        if ($role !== 'admin') {
            header('Location: /projet-commerce-nba/public/product_client');
            exit;
        }
        $id = $_GET['id'];
        $categoryController->delete($id);
        break;

    case strpos($requestUri, 'projet-commerce-nba/public/categories/edit') !== false:
        if ($role !== 'admin') {
            header('Location: /projet-commerce-nba/public/product_client');
            exit;
        }
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

    // Product routes (admin-only)
    case $requestUri === 'projet-commerce-nba/public/products':
        if ($role !== 'admin') {
            header('Location: /projet-commerce-nba/public/product_client');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $stock = $_POST['stock'];
                $category_id = $_POST['category_id'];
                $image = $_FILES['image'] ?? null;
                $productController->update($id, $name, $description, $price, $stock, $category_id, $image);
            } else {
                $name = $_POST['name'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $stock = $_POST['stock'];
                $category_id = $_POST['category_id'];
                $image = $_FILES['image'] ?? null;
                $productController->create($name, $description, $price, $stock, $category_id, $image);
            }
        } else {
            $productController->handleRequest();
        }
        break;

    case strpos($requestUri, 'projet-commerce-nba/public/products/delete') !== false:
        if ($role !== 'admin') {
            header('Location: /projet-commerce-nba/public/product_client');
            exit;
        }
        $id = $_GET['id'];
        $productController->delete($id);
        break;

    case strpos($requestUri, 'projet-commerce-nba/public/products/edit') !== false:
        if ($role !== 'admin') {
            header('Location: /projet-commerce-nba/public/product_client');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $stock = $_POST['stock'];
            $category_id = $_POST['category_id'];
            $image = $_FILES['image'] ?? null;
            $productController->update($id, $name, $description, $price, $stock, $category_id, $image);
        } else {
            $id = $_GET['id'];
            $productController->edit($id);
        }
        break;

    case strpos($requestUri, 'projet-commerce-nba/public/products') === 0:
        if ($role !== 'admin') {
            header('Location: /projet-commerce-nba/public/product_client');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle product creation or updates
            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $stock = $_POST['stock'];
                $category_id = $_POST['category_id'];
                $image = $_FILES['image'] ?? null;
                $productController->update($id, $name, $description, $price, $stock, $category_id, $image);
            } else {
                $name = $_POST['name'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $stock = $_POST['stock'];
                $category_id = $_POST['category_id'];
                $image = $_FILES['image'] ?? null;
                $productController->create($name, $description, $price, $stock, $category_id, $image);
            }
        } else {
            // Handle filtering products
            $queryParams = [];
            parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), $queryParams);

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
        $errorMessage = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            if ($userController->login($email, $password)) {
                header('Location: /projet-commerce-nba/public');
                exit;
            } else {
                $errorMessage = "Identifiants invalides. Veuillez réessayer.";
            }
        }
        require_once '../src/Views/login.php';
        break;

    // User logout
    case $requestUri === 'projet-commerce-nba/public/logout':
        $userController->logout();
        header('Location: /projet-commerce-nba/public/login');
        exit;
        break;

    // User routes (admin-only)
    case $requestUri === 'projet-commerce-nba/public/users':
        if ($role !== 'admin') {
            header('Location: /projet-commerce-nba/public/product_client');
            exit;
        }
        $users = $userController->listUsers();
        require_once '../src/Views/users.php';
        break;

    case strpos($requestUri, 'projet-commerce-nba/public/users/update') !== false:
        if ($role !== 'admin') {
            // Only admins can update users
            header('Location: /projet-commerce-nba/public/product_client');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get data from the request
            $id = $_POST['id'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $role = $_POST['role'];

            // Update the user with the provided data
            $userController->updateUser($id, $first_name, $last_name, $email, $role);

            // Redirect back to the user list
            header('Location: /projet-commerce-nba/public/users');
            exit;
        }
        break;

    case $requestUri === 'projet-commerce-nba/public/users/create':
        if ($role !== 'admin') {
            // Restrict access to non-admin users
            header('Location: /projet-commerce-nba/public/product_client');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle the form submission to create a new user
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            $userController->createUser($first_name, $last_name, $email, $password, $role);

            // Redirect back to the users list
            header('Location: /projet-commerce-nba/public/users');
            exit;
        } else {
            // Display the form to create a user
            require_once '../src/Views/create_user.php';
        }
        break;

    case strpos($requestUri, 'projet-commerce-nba/public/users/edit') !== false:
        if ($role !== 'admin') {
            // Redirect clients to product client page
            header('Location: /projet-commerce-nba/public/product_client');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle form submission to update the user
            $id = $_GET['id'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $role = $_POST['role'];

            $userController->updateUser($id, $first_name, $last_name, $email, $role);

            // Redirect back to the users list
            header('Location: /projet-commerce-nba/public/users');
            exit;
        } else {
            // Display the edit form
            $id = $_GET['id'];
            $user = $userController->getUserById($id);
            require_once '../src/Views/edit_user.php';
        }
        break;


    case strpos($requestUri, 'projet-commerce-nba/public/users/delete') !== false:
        if ($role !== 'admin') {
            header('Location: /projet-commerce-nba/public/product_client');
            exit;
        }
        $id = $_GET['id'];
        $userController->deleteUser($id);
        header('Location: /projet-commerce-nba/public/users');
        exit;
        break;

    case $requestUri === 'projet-commerce-nba/public/nba_articles/create':
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /projet-commerce-nba/public/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'author' => $_POST['author'],
                'tags' => explode(',', $_POST['tags']),
                'team' => $_POST['team'],
                'player' => $_POST['player']
            ];
            $articleController->createArticle($data);
            header('Location: /projet-commerce-nba/public/nba_articles');
            exit;
        } else {
            require_once '../src/Views/create_article.php';
        }
        break;

        case $requestUri === 'projet-commerce-nba/public/nba_articles':
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $articles = $articleController->listArticles(); 
                require_once '../src/Views/list_articles.php'; 
            }
            break;

    default:
        echo "<h1>404 - Page non trouvée</h1>";
        break;
}
