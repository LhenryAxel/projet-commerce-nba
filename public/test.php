<?php
require_once '../core/MongoDBConnection.php';

try {
    $mongo = new MongoDBConnection();
    $db = $mongo->getDatabase();
    echo "Connexion réussie à la base de données MongoDB : " . $db->__toString();
} catch (Exception $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
