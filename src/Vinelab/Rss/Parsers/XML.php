<?php

namespace Vinelab\Rss\Parsers;

use SimpleXMLElement;
use Vinelab\Rss\Contracts\ParserInterface;
use Vinelab\Rss\Exceptions\InvalidXMLException;
use Vinelab\Rss\Exceptions\InvalidFeedContentException;
use Vinelab\Rss\Feeds\AtomFeed;
use Vinelab\Rss\Feeds\RSSFeed;

class XML implements ParserInterface
{
    public function parse($xml)
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
