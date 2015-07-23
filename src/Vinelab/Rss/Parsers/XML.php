<?php

namespace Vinelab\Rss\Parsers;

use SimpleXMLElement;
use Vinelab\Rss\Feed;
use Vinelab\Rss\Contracts\ParserInterface;
use Vinelab\Rss\Exceptions\InvalidXMLException;
use Vinelab\Rss\Exceptions\InvalidFeedContentException;

class XML implements ParserInterface
{
    public function parse($xml)
    {
        if (!$xml instanceof SimpleXMLElement) {
            throw new InvalidXMLException();
        }

        if (!isset($xml->channel->item)) {
            throw new InvalidFeedContentException();
        }

        return Feed::make((array) $xml->channel);
    }
}
