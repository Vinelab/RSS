<?php

namespace Vinelab\Rss;

use Vinelab\Rss\Exceptions\InvalidFeedChannelException;

class Feed implements Contracts\FeedInterface
{
    /**
     * Information about the feed.
     *
     * @var array
     */
    protected $info = array();

    /**
     * The articles of the feed.
     *
     * @var ArticlesCollection
     */
    protected $articles;

    public function __construct($channel)
    {
        if (!is_array($channel)) {
            throw new InvalidFeedChannelException();
        }

        $this->setInfo($channel);

        $this->setArticles($channel);
    }

    public static function make($channel)
    {
        return new static($channel);
    }

    /**
     * Add an article to the feed.
     *
     * @param mixed $entry
     */
    public function addArticle($entry)
    {
        $article = Article::make($entry);

        $this->articles->push($article);

        return $article;
    }

    /**
     * Return the feed info.
     *
     * @return array
     */
    public function info()
    {
        return $this->info;
    }

    /**
     * Return the feed articles.
     *
     * @return array
     */
    public function articles()
    {
        return $this->articles;
    }

    /**
     * The number of articles in this feed.
     *
     * @return int
     */
    public function articlesCount()
    {
        return count($this->articles);
    }

    public function __get($attr)
    {
        if ($attr === 'articles') {
            return $this->articles;
        }

        return (isset($this->info[$attr])) ? $this->info[$attr] : null;
    }
}
