<?php
namespace Controllers;

require_once '../src/Models/User.php';

use Models\User;

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function register($first_name, $last_name, $email, $password) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        return $this->userModel->register($first_name, $last_name, $email, $password_hash);
    }

    public function login($email, $password) {
        $user = $this->userModel->findByEmail($email);
        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user'] = $user;
            return true;
        }
        return false;
    }

    public function logout() {
        session_destroy();
        unset($_SESSION['user']);
    }

    public function listUsers() {
        return $this->userModel->getAllUsers();
    }

    public function createUser($first_name, $last_name, $email, $password, $role) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        return $this->userModel->createUser($first_name, $last_name, $email, $password_hash, $role);
    }

    public function editUser($id, $data = null) {
        $user = $this->userModel->findById($id);
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $updatedData = [
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'role' => $data['role']
            ];
            $this->userModel->update($id, $updatedData);
            header('Location: /projet-commerce-nba/public/users');
            exit;
        }
    
        require_once '../src/Views/edit_user.php';
    }    

    public function deleteUser($id) {
        return $this->userModel->deleteUser($id);
    }

    public function getUserById($id) {
        return $this->userModel->findById($id);
    }
}
