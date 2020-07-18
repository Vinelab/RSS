<?php

namespace Vinelab\Rss\Tests\Feeds;

use SimpleXMLElement;
use Vinelab\Rss\Feeds\RSSFeed;
use PHPUnit\Framework\TestCase;
use Vinelab\Rss\Exceptions\InvalidFeedChannelException;

class RSSFeedTest extends TestCase
{
    public function test_rss_092_xml()
    {
        $xml = new SimpleXMLElement(file_get_contents(__DIR__.'/../samples/0.92.rss.xml'));
        $rss = new RSSFeed((array) $xml->channel);

        $expectedInfo = [
            'title' => 'Dave Winer: Grateful Dead',
            'link' => 'http://www.scripting.com/blog/categories/gratefulDead.html',
            'description' => "A high-fidelity Grateful Dead song every day. This is where we're experimenting with enclosures on RSS news items that download when you're not using your computer. If it works (it will) it will be the end of the Click-And-Wait multimedia experience on the Internet. ",
            'lastBuildDate' => 'Fri, 13 Apr 2001 19:23:02 GMT',
            'docs' => 'http://backend.userland.com/rss092',
            'managingEditor' => 'dave@userland.com (Dave Winer)',
            'webMaster' => 'dave@userland.com (Dave Winer)',
        ];

        $this->assertEquals($expectedInfo, $rss->info());
        $this->assertCount(22, $rss->articles());
        foreach ($rss->articles() as $article) {
            $this->assertNotEmpty($article->description);
        }
    }

    public function test_rss_2_xml()
    {
        $xml = new SimpleXMLElement(file_get_contents(__DIR__.'/../samples/2.rss.xml'));
        $rss = new RSSFeed((array) $xml->channel);

        $expectedInfo = [
            'title' => 'Scripting News',
            'link' => 'http://www.scripting.com/',
            'description' => 'A weblog about scripting and stuff like that.',
            'lastBuildDate' => 'Mon, 30 Sep 2002 11:00:00 GMT',
            'docs' => 'http://backend.userland.com/rss',
            'managingEditor' => 'dave@userland.com',
            'webMaster' => 'dave@userland.com',
            'language' => 'en-us',
            'copyright' => 'Copyright 1997-2002 Dave Winer',
            'generator' => 'Radio UserLand v8.0.5',
            'category' => '1765',
            'ttl' => '40',
        ];

        $this->assertEquals($expectedInfo, $rss->info());
        $this->assertCount(9, $rss->articles());
        foreach ($rss->articles() as $article) {
            $this->assertNotEmpty($article->description);
            $this->assertNotEmpty($article->guid);
            $this->assertNotEmpty($article->pubDate);
        }
    }

    public function test_invalid_rss()
    {
        $this->expectException(InvalidFeedChannelException::class);
        new RSSFeed('this is a string');
    }
}

