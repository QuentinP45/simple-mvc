<?php

namespace App\Controllers;

use App\Models\Article;
use App\Models\ArticleManager;
use App\Views\View;

class HomeController
{   
    public function __construct()
    {
        // GET SOME ARTICLES
        $articleManager = new ArticleManager;

        $articles = $articleManager->getLastArticles('article', 'Article', 3);
        
        // DISPLAY HOME VIEW
        $view = new View;
        echo $view->generateView('home\homeView', $articles);
    }
}
