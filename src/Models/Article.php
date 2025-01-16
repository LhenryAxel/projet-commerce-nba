<?php

namespace Models;

use Core\MongoDBConnection;

class Article {
    private $collection;

    public function __construct() {
        $dbConnection = new MongoDBConnection();
        $this->collection = $dbConnection->getDb()->nba_articles;
    }

    public function create($data) {
        return $this->collection->insertOne($data);
    }

    public function read($filters = []) {
        return $this->collection->find($filters)->toArray();
    }

    public function update($id, $data) {
        return $this->collection->updateOne(
            ['_id' => new \MongoDB\BSON\ObjectId($id)],
            ['$set' => $data]
        );
    }

    public function getAllArticles() {
        return $this->collection->find()->toArray();
    }
     

    public function delete($id) {
        return $this->collection->deleteOne(['_id' => new \MongoDB\BSON\ObjectId($id)]);
    }
}
