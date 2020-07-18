<?php

namespace Vinelab\Rss\Tests\Parsers;

use SimpleXMLElement;
use Vinelab\Rss\Parsers\XML;
use PHPUnit\Framework\TestCase;
use Vinelab\Rss\Exceptions\InvalidXMLException;
use Vinelab\Rss\Exceptions\InvalidFeedContentException;

class XMLTest extends TestCase
{
    public static $feed;

    public static $hunger;

    public static $invalid;

    private $xml;

    public static function setUpBeforeClass() : void
    {
        self::$hunger = 'something that is not XML';
        self::$feed = new SimpleXMLElement(file_get_contents(__DIR__ . '/samples/valid.xml'));
        self::$invalid = new SimpleXMLElement(file_get_contents(__DIR__ . '/samples/invalid.xml'));
    }

    public function setUp() : void
    {
        $this->xml = new XML();
    }

    public function test_parsing_valid_feed()
    {
        $feed = self::$feed;
        $feed = $this->xml->parse($feed);

        $this->assertInstanceOf('Vinelab\Rss\Contracts\FeedInterface', $feed);
        $this->assertInstanceOf('Vinelab\Rss\Feed', $feed);
    }

    public function test_parsing_invalid_xml()
    {
        $this->expectException(InvalidXMLException::class);
        $this->xml->parse(self::$hunger);
    }

    public function test_parsing_invalid_feed()
    {
        $this->expectException(InvalidFeedContentException::class);
        $this->xml->parse(self::$invalid);
    }
}
