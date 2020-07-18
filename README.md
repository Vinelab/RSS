[![Build Status](https://travis-ci.org/Vinelab/RSS.png)](https://travis-ci.org/Vinelab/RSS)

# RSS Client
A simple and radical RSS client that supports RSS 0.92, 2.0 and Atom feeds.

## Synopsis
**Fetch Feeds**
```php
$rss->feed('https://stackoverflow.com/feeds/tag?tagnames=php&amp;sort=newest');
```

**Parse Feeds**
```php
$feed->info();
$feed->articles();
```

## Installation
`composer require vinelab/rss`

#### Laravel Setup
Edit **app.php** and add ```'Vinelab\Rss\RssServiceProvider',``` to the ```'providers'``` array.

It will automatically alias itself as **RSS** so no need to aslias it in your **app.php** unless you would like to customize it. In that case edit your **'aliases'** in **app.php** adding ``` 'MyRSS'    => 'Vinelab\Rss\Facades\RSS',```

## Usage

### Fetch an RSS feed

```php
require 'vendor/autoload.php';

use Vinelab\Rss\Rss;

$rss = new Rss();
$feed = $rss->feed('https://stackoverflow.com/feeds/tag?tagnames=php&amp;sort=newest');

// $feed is now an instance of Vinelab\Rss\Feed

$info = $feed->info();
$count = $feed->articlesCount();
$articles = $feed->articles();
```

#### Feed Info
```php
$info = $feed->info();

echo json_encode($info);
```

```json
{
   "title": "Newest questions tagged php - Stack Overflow",
   "subtitle": "most recent 30 from stackoverflow.com",
   "updated": "2020-07-16T19:14:29Z",
   "id": "https://stackoverflow.com/feeds/tag?tagnames=php&sort=newest"
 }
```

#### Feed Articles

**Accessing Articles**
```php
$articles = $feed->articles();
```

This will give you an instance of `Vinelab\Rss\ArticlesCollection` which is
an extension of [Illuminate\Support\Collection](https://laravel.com/docs/7.x/collections).
Each item of this collection is an instance of `Vinelab\Rss\Article` from which you can safely access any of the properties in the entry.

**Article**

Is an object which properties are dynamically accessed such as `$article->title`.

Whichever fields exist in the feed's entry will be accessible as read-only
property, making `Article` an immutable object.

You may also call `isset($article->someField)` to check whether the field exists for a designated entry.

```php
$article = $articles->first();

echo $article->title; // ABBA piano seen raising money, money, money at auction

echo $article->whatever; // null
```

Or iterate through the articles
```php
foreach ($feed->articles() as $article) {
  $title = $article->title;
}
```

### Got Questions?
Reach out in the [issues](https://github.com/vinelab/rss/issues).

---

[MIT LICENSE](/LICENSE)
