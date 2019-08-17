<?php

namespace App\Controllers;

use App\Models\Article;
use App\Models\ArticleManager;

class HomeController
{   
    public function __construct()
    {
        // GET SOME ARTICLES
        $articleManager = new ArticleManager;

        $articles = $articleManager->getLastArticles('article', 'Article', 3);
        
        // TO DO: DISPLAY HOME VIEW
    }
}
