<?php

namespace Vinelab\Rss\Feeds;

use Vinelab\Rss\ArticlesCollection;
use Vinelab\Rss\Feed;

class AtomFeed extends Feed
{
    /**
     * Set the information for the feed.
     *
     * @param array $channel
     */
    public function setInfo($channel)
    {
        unset($channel['entry']);

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

        if(is_array($channel['entry'])){
            foreach ($channel['entry'] as $entry) {
                $this->addArticle($entry);
            }
        }else{
            $this->addArticle($channel['entry']);
        }
    }
}