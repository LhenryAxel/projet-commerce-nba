<?php
namespace Core;

require_once __DIR__ . '/../vendor/autoload.php';

use MongoDB\Client;

class MongoDBConnection {
    private $client;
    private $database;

    public function __construct($uri = "mongodb://127.0.0.1:27017", $dbName = "projet-commerce-nba") {
        $this->client = new Client($uri);
        $this->database = $this->client->$dbName;
    }

    public function getDb() {
        return $this->database;
    }
}
