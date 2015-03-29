# Bard

[![Build Status](https://travis-ci.org/laravelista/Bard.svg)](https://travis-ci.org/laravelista/Bard) [![Latest Stable Version](https://poser.pugx.org/laravelista/bard/v/stable.svg)](https://packagist.org/packages/laravelista/bard) [![Total Downloads](https://poser.pugx.org/laravelista/bard/downloads.svg)](https://packagist.org/packages/laravelista/bard) [![Latest Unstable Version](https://poser.pugx.org/laravelista/bard/v/unstable.svg)](https://packagist.org/packages/laravelista/bard) [![License](https://poser.pugx.org/laravelista/bard/license.svg)](https://packagist.org/packages/laravelista/bard)

Tired of unstable and bloated PHP sitemap packages?
 
**Look no more!** 

Bard is the simplest PHP Sitemap package, just add some urls and you are ready to go. Did I mention that *it supports multilingual locations aka hreflangs*. 
 
**But wait, there is more.** 
 
If you are using Laravel you'll have access to some *extra awesomeness* with convenient helper functions that make creating sitemaps a breeze.
 
## Installation
 
```
composer require laravelista/bard
```

## Usage

### General usage

```
use Laravelista\Bard\Sitemap;
use Sabre\Xml\Writer;

$sitemap = new Sitemap(new Writer);
```

### Dependency injection in Laravel

```
use Laravelista\Bard\Sitemap;

class SitemapController {

    protected $sitemap;

    public function __construct(Sitemap $sitemap) 
    {
        $this->sitemap = $sitemap;
    }

}
```

### Resolve out of Service Container IoC in Laravel

```
$sitemap = App::make('Laravelista\Bard\Sitemap')
```