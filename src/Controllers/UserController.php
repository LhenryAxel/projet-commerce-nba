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
}
