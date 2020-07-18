<?php

namespace Vinelab\Rss\Feeds;

use Vinelab\Rss\Feed;
use Vinelab\Rss\ArticlesCollection;

class RSSFeed extends Feed
{
    /**
     * Set the information for the feed.
     *
     * @param array $channel
     */
    public function setInfo($channel)
    {
        unset($channel['item']);

        $this->info = $channel;
    }

    /**
     * Set the articles for the feed.
     *
     * @param array $channel
     */
    public function setArticles($channel)
    {
        $this->articles = new ArticlesCollection();

        if (is_array($channel['item'])) {

            foreach ($channel['item'] as $item) {
                $this->addArticle($item);
            }

        } elseif (isset($channel['item'])) {
            $this->addArticle($channel['item']);
        }
    }
}