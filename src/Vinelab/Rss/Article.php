<?php

namespace Vinelab\Rss;

class Article
{
    /**
     * Holds the article information.
     *
     * @var array
     */
    protected $info = array();

    /**
     * Create a new Rss Article instance.
     *
     * @param mixed $article
     */
    public function __construct($article)
    {
        foreach ($article as $attribute => $value) {
            $this->info[$attribute] = (string) $value;
        }
    }

    /**
     * Instantiate an Article.
     *
     * @param mixed $article
     *
     * @return Vinelab\Rss\Article
     */
    public static function make($article)
    {
        return new static($article);
    }

    /**
     * A gateway to return the data stored in $info.
     *
     * @param string $element
     *
     * @return mixed
     */
    public function __get($element)
    {
        return isset($this->info[$element]) ? $this->info[$element] : null;
    }
}
