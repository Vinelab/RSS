<?php

namespace Vinelab\Rss;

class Article
{
    /**
     * Holds the original SimpleXMLElement
     *
     * @var SimpleXMLElement
     */
    protected $element = null;

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
        $this->element = $article;

        foreach ($article as $attribute => $value) {
            // for enclosure, get the attributes as array
            if ($attribute == 'enclosure')
                $value = current($value->attributes());
            else
                $value = (string) $value;

            $this->info[$attribute] = $value;
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
     * Get the original SimpleXMLElement
     *
     * @return SimpleXMLElement
     */
    public function getElement()
    {
        return $this->element;
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
