<?php

namespace Controllers;

use Models\Category;

class CategoryController {
    private $model;

    public function __construct() {
        $this->model = new Category();
    }

    // Handle the category list display
    public function handleRequest() {
        $categories = $this->model->getAll();
        $categories = $this->model->getProductCountByCategory();

        require_once '../src/Views/categories.php';
    }

    // Create a new category
    public function create($name, $description) {
        if ($this->model->create($name, $description)) {
            header('Location: /projet-commerce-nba/public/categories');
            exit;
        } else {
            echo "Error while creating the category.";
        }
    }

    // Delete a category by its ID
    public function delete($id) {
        if ($this->model->delete($id)) {
            header('Location: /projet-commerce-nba/public/categories');
            exit;
        } else {
            echo "Error while deleting the category.";
        }
    }

    // Display the edit form for a specific category
    public function edit($id) {
        // Fetch the current data of the category
        $category = $this->model->getById($id);
    
        require_once '../src/Views/edit_category.php';
    }
    
    // Update an existing category
    public function update($id, $name, $description) {
        if ($this->model->update($id, $name, $description)) {
            header('Location: /projet-commerce-nba/public/categories');
            exit;
        } else {
            echo "Error while updating the category.";
        }
    }    
}
