<?php

namespace Vinelab\Rss\Tests\Feeds;

use SimpleXMLElement;
use PHPUnit\Framework\TestCase;
use Vinelab\Rss\Feeds\AtomFeed;

class AtomFeedTest extends TestCase
{
    public function test_atom_feed()
    {
        $xml = new SimpleXMLElement(file_get_contents(__DIR__.'/../samples/atom.xml'));
        $feed = new AtomFeed((array) $xml);

        $expectedInfo = [
            'title' => 'Newest questions tagged php - Stack Overflow',
            'subtitle' => 'most recent 30 from stackoverflow.com',
            'updated' => '2020-07-16T19:14:29Z',
            'id' => 'https://stackoverflow.com/feeds/tag?tagnames=php&sort=newest',
        ];

        $this->assertEquals($expectedInfo, $feed->info());
        $this->assertCount(30, $feed->articles());

        foreach ($feed->articles() as $article) {
            $this->assertNotEmpty($article->id);
            $this->assertNotEmpty($article->title);
            $this->assertNotEmpty($article->published);
            $this->assertNotEmpty($article->updated);
            $this->assertNotEmpty($article->summary);
            $this->assertTrue(isset($article->category));
            $this->assertTrue(isset($article->author));
            $this->assertTrue(isset($article->link));
        }
    }
}