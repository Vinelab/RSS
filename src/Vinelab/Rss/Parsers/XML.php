<?php

namespace Vinelab\Rss\Parsers;

use SimpleXMLElement;
use Vinelab\Rss\Feeds\RSSFeed;
use Vinelab\Rss\Feeds\AtomFeed;
use Vinelab\Rss\Contracts\FeedInterface;
use Vinelab\Rss\Contracts\ParserInterface;
use Vinelab\Rss\Exceptions\InvalidXMLException;
use Vinelab\Rss\Exceptions\InvalidFeedContentException;

class XML implements ParserInterface
{
    public function parse($xml) : FeedInterface
    {
        if (!$xml instanceof SimpleXMLElement) {
            throw new InvalidXMLException();
        }

        if (isset($xml->channel->item)) {
            return RSSFeed::make((array) $xml->channel);
        }

        if (isset($xml->entry)) {
            return AtomFeed::make((array) $xml);
        }

        throw new InvalidFeedContentException();
    }
}
