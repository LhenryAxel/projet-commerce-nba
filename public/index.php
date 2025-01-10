<?php

require_once '../core/Database.php';
require_once '../src/Models/Category.php';
require_once '../src/Controllers/CategoryController.php';

use Controllers\CategoryController;

$categoryController = new CategoryController();

$requestUri = trim($_SERVER['REQUEST_URI'], '/');

// Route handling
if ($requestUri === 'projet-commerce-nba/public') {
    echo "<h1>Bienvenue dans l'application NBA Store</h1>";
    echo '<a href="/projet-commerce-nba/public/categories">Gérer les catégories</a>';
} 
elseif ($requestUri === 'projet-commerce-nba/public/categories') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Add a new category
        $name = $_POST['name'];
        $description = $_POST['description'];
        $categoryController->create($name, $description);
    } else {
        // Display the category list
        $categoryController->handleRequest();
    }
} 
elseif (strpos($requestUri, 'projet-commerce-nba/public/categories/delete') !== false) {
    // Delete a category
    $id = $_GET['id'];
    $categoryController->delete($id);
}
elseif (strpos($requestUri, 'projet-commerce-nba/public/categories/edit') !== false) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Update an existing category
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $categoryController->update($id, $name, $description);
    } else {
        // Display the edit form for a specific category
        $id = $_GET['id'];
        $categoryController->edit($id);
    }
} 
else {
    echo "<h1>404 - Page not found</h1>";
}
