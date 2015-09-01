[![Build Status](https://travis-ci.org/Vinelab/RSS.png)](https://travis-ci.org/Vinelab/RSS)

## RSS 2.0 Client

### Installation
`composer require vinelab/rss`

#### Laravel Setup
Edit **app.php** and add ```'Vinelab\Rss\RssServiceProvider',``` to the ```'providers'``` array.

It will automatically alias itself as **RSS** so no need to aslias it in your **app.php** unless you would like to customize it. In that case edit your **'aliases'** in **app.php** adding ``` 'MyRSS'    => 'Vinelab\Rss\Facades\RSS',```

## Usage

### Fetch an RSS feed
> Assuming (and hoping) that you're using [Composer](http://getcomposer.org) to manage your project's dependencies.

```php
require 'vendor/autoload.php';

use Vinelab\Rss\Rss;

$rss = new Rss();
$feed = $rss->feed('http://feeds.reuters.com/news/artsculture');

// $feed is now an instance of Vinelab\Rss\Feed

$count = $feed->articlesCount(); // 10
```

#### Feed Info
```php
$info = $feed->info();

echo json_encode($info);
```

```json
{
    "title":"Reuters: Arts",
    "link":"http:\/\/www.reuters.com",
    "description":"Reuters.com is your source for breaking news, business, financial and investing news, including personal finance and stocks.  Reuters is the leading global provider of news, financial information and technology solutions to the world's media, financial institutions, businesses and individuals.",
    "image":{
        "title":"Reuters News",
        "width":"120",
        "height":"35",
        "link":"http:\/\/www.reuters.com",
        "url":"http:\/\/www.reuters.com\/resources_v2\/images\/reuters125.png"
    },
    "language":"en-us",
    "lastBuildDate":"Tue, 01 Sep 2015 11:25:09 -0400",
    "copyright":"All rights reserved. Users may download and print extracts of content from this website for their own personal and non-commercial use only. Republication or redistribution of Reuters content, including by framing or similar means, is expressly prohibited without the prior written consent of Reuters. Reuters and the Reuters sphere logo are registered trademarks or trademarks of the Reuters group of companies around the world. \u00a9 Reuters 2015"
}
```

#### Feed Articles
```php
$articles = $feed->articles();
```

This will give you a collection of articles, of Vinelab\Rss\ArticlesCollection which is
an extension of Illuminate\Support\Collection. Each item of this collection is an instance
of Vinelab\Rss\Article from which you can safely access any of the properties you wish.

```php
$article = $articles->first();

echo $article->title; // ABBA piano seen raising money, money, money at auction

echo $article->whatever; // null
```
