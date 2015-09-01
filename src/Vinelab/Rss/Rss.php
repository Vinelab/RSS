<?php

namespace Vinelab\Rss;

use Vinelab\Http\Client;
use Vinelab\Rss\Parsers\XML;
use Vinelab\Rss\Parsers\JSON;
use Vinelab\Http\Client as HttpClient;
use Vinelab\Rss\Exceptions\InvalidFeedFormatException;

class Rss
{
    /**
     * The XML parser instance.
     *
     * @var Vinelab\Rss\Parsers\XML
     */
    protected $xml;

    /**
     * The JSON parser instance.
     *
     * @var Vinelab\Rss\Parsers\JSON
     */
    protected $json;

    /**
     * The HTTP client instance.
     *
     * @var Vinelab\Http\Client
     */
    protected $http;

    public function __construct(XML $xml = null, HttpClient $http = null)
    {
        $this->xml = $xml ?: new XML();
        $this->http = $http ?: new HttpClient();
    }

    /**
     * Fetch and return an RSS feed.
     *
     * @param string $url
     * @param string $format
     *
     * @return Vinelab\Rss\ArticlesCollection
     */
    public function feed($url, $format = 'xml')
    {
        return $this->parse($this->fetch($url), $format);
    }

    /**
     * Fetch the feed from source.
     *
     * @param string $url
     *
     * @return mixed
     */
    public function fetch($url)
    {
        return $this->http->get(trim($url));
    }

    /**
     * Prepares a feed URL to be
     * requestable.
     *
     * @param string $url
     *
     * @return string
     */
    public function prepareURL($url)
    {
        return preg_replace('/^feed:\/\//', 'http://', $url);
    }

    /**
     * Prases the feed according to the format.
     *
     * @param mixed  $feed
     * @param string $format
     *
     * @return Vinelab\Rss\ArticlesCollection
     */
    public function parse($response, $format)
    {
        switch ($format) {
            case 'xml':
                return $this->xml->parse($response->xml());
            break;

            default:
                throw new InvalidFeedFormatException($format);
            break;
        }
    }
}
