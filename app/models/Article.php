<?php

namespace App\Models;

class Article
{
    private $id;
    private $title;
    private $date;
    private $content;

    public function __construct(object $article)
    {
        foreach ($article as $key => $value) {
            $method = 'set' . ucFirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    // GETTERS
    
    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getContent()
    {
        return $this->content;
    }

    // SETTERS

    public function setId($id)
    {
        $id = (int) $id;
        if ($id > 0) {
            $this->id = $id;
        }

        return $this;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }
}
