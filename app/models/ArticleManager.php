<?php

namespace App\Models;

use App\Models\Model;

class ArticleManager extends Model
{
    public function getAllArticles($table, $object)
    {
        $articlesData = $this->getAll($table);

        $articles = $this->dataToObject($articlesData, $object);

        return $articles;
    }

    public function getLastArticles($table, $object, $limit)
    {
        $articlesData = $this->getLast($table, $limit);

        $articles = $this->dataToObject($articlesData, $object);

        return $articles;
    }

    public function getArticleById($table, $object, $id)
    {
        $articleData = $this->getOneById($table, $id);

        $article = $this->dataToObject($articleData, $object);

        return $article;
    }

    public function editArticleById($table, $id, $dataToEdit)
    {
        $this->editOneById($table, $id, $dataToEdit);
    }

    public function createArticle($table, $dataToCreate)
    {
        $this->createOne($table, $dataToCreate);
    }

    public function deleteArticleById($table, $id)
    {
        $this->deleteById($table, $id);
    }
}
