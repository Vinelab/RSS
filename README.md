## RSS 2.0 Client

## Installation
Refer to [vinelab/rss on packagist.org](https://packagist.org/packages/vinelab/rss) for composer installation instructions.

Edit **app.php** and add ```'Vinelab\Http\HttpServiceProvider',``` to the ```'providers'``` array.

It will automatically alias itself as **RSS** so no need to aslias it in your **app.php** unless you would like to customize it. In that case edit your **'aliases'** in **app.php** adding ``` 'MyRSS'    => 'Vinelab\Rss\Facades\RSS',```

## Usage

### Fetch an RSS feed
```php
<?php

$feed = RSS::feed('http://feeds.reuters.com/news/artsculture');

// $feed is now an instance of Vinelab\Rss\Feed

$count = $feed->articlesCount(); // 10

$info = $feed->info();

/*
 info:

array (size=7)
  'title' => string 'Reuters: Arts' (length=13)
  'link' => string 'http://www.reuters.com' (length=22)
  'description' => string 'Reuters.com is your source for breaking news, business, financial and investing news, including personal finance and stocks.  Reuters is the leading global provider of news, financial information and technology solutions to the world's media, financial institutions, businesses and individuals.' (length=294)
  'image' =>
    object(SimpleXMLElement)[214]
      public 'title' => string 'Reuters News' (length=12)
      public 'width' => string '120' (length=3)
      public 'height' => string '35' (length=2)
      public 'link' => string 'http://www.reuters.com' (length=22)
      public 'url' => string 'http://www.reuters.com/resources_v2/images/reuters125.png' (length=57)
  'language' => string 'en-us' (length=5)
  'lastBuildDate' => string 'Mon, 16 Dec 2013 07:37:00 -0500' (length=31)
  'copyright' => string 'All rights reserved. Users may download and print extracts of content from this website for their own personal and non-commercial use only. Republication or redistribution of Reuters content, including by framing or similar means, is expressly prohibited without the prior written consent of Reuters. Reuters and the Reuters sphere logo are registered trademarks or trademarks of the Reuters group of companies around the world. Â© Reuters 2013' (length=444)
*/

$articles = $feed->articles();

/*
    articles:

    This is a child from Illuminate\Support\Collection, which means
    you can apply any of the applicable functionalities to it.

    object(Vinelab\Rss\ArticlesCollection)[213]
      protected 'items' =>
        array (size=10)
          0 =>
            object(Vinelab\Rss\Article)[236]
              protected 'info' =>
                array (size=6)
                  ...
 */

//
```