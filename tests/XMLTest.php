<?php

namespace Vinelab\Rss\Tests\Parsers;

use PHPUnit_Framework_TestCase as TestCase;
use SimpleXMLElement;
use Vinelab\Rss\Parsers\XML;

class XMLTest extends TestCase
{
    public static $feed;

    public static $hunger;

    public static $invalid;

    public static function setUpBeforeClass()
    {
        self::$hunger = 'something that is not XML';
        self::$feed = new SimpleXMLElement(file_get_contents('./tests/feeds/xxx.xml'));
        self::$invalid = new SimpleXMLElement(file_get_contents('./tests/feeds/invalid.xml'));
    }

    public function setUp()
    {
        $this->xml = new XML($this->articles);
    }

    public function test_parsing_valid_feed()
    {
        $feed = self::$feed;
        $feed = $this->xml->parse($feed);

        $this->assertInstanceOf('Vinelab\Rss\Contracts\FeedInterface', $feed);
        $this->assertInstanceOf('Vinelab\Rss\Feed', $feed);
    }

    /**
     * @expectedException Vinelab\Rss\Exceptions\InvalidXMLException
     */
    public function test_parsing_invalid_xml()
    {
        $this->xml->parse(self::$hunger);
    }

    /**
     * @expectedException Vinelab\Rss\Exceptions\InvalidFeedContentException
     */
    public function test_parsing_invalid_feed()
    {
        $this->xml->parse(self::$invalid);
    }
}
