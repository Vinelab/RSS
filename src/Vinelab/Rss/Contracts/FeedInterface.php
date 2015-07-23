<?php

namespace Vinelab\Rss\Contracts;

interface FeedInterface
{
    public static function make($channel);

    public function addArticle($entry);

    public function info();

    public function articles();

    public function articlesCount();
}
