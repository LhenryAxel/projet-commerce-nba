<?php

namespace Controllers;

use Models\Article;

class ArticleController {
    private $articleModel;

    public function __construct() {
        $this->articleModel = new Article();
    }

    public function createArticle($data) {
        $data['created_at'] = new \MongoDB\BSON\UTCDateTime();
        $this->articleModel->create($data);
        header('Location: /projet-commerce-nba/public/nba_articles');
        exit; 
    }
    

    public function listArticles() {
        return $this->articleModel->getAllArticles(); 
    }    
}
