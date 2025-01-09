<?php
require_once '../database.php';

use Core\Database;

$db = new Database();

try {
    $connection = $db->getConnection();
    echo "Connexion réussie à la base de données.";
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
