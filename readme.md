# Bard

[![Build Status](https://travis-ci.org/laravelista/Bard.svg)](https://travis-ci.org/laravelista/Bard) [![Latest Stable Version](https://poser.pugx.org/laravelista/bard/v/stable.svg)](https://packagist.org/packages/laravelista/bard) [![Total Downloads](https://poser.pugx.org/laravelista/bard/downloads.svg)](https://packagist.org/packages/laravelista/bard) [![License](https://poser.pugx.org/laravelista/bard/license.svg)](https://packagist.org/packages/laravelista/bard)

![Bard](http://news.cdn.leagueoflegends.com/public/images/pages/2015/breveal/img/Promo_Bard_Reveal_BardFloating.png)

Tired of unstable and bloated PHP sitemap packages?
 
**Look no more!** 

Bard is the simplest PHP Sitemap package, just add some URLs and you are ready to go. Did I mention that *it supports multilingual locations aka hreflangs*. 

## Syntax

```
use Laravelista\Bard\UrlSet;
use Sabre\Xml\Writer;
use Carbon\Carbon;

$sitemap = new UrlSet(new Writer);

$sitemap->addUrl('http://domain.com/contact')
    ->setPriority(0.8)
    ->setChangeFrequency('hourly')
    ->setLastModification(Carbon::now())
    ->addTranslation('hr', 'http://domain.com/hr/contact');

$sitemap->render()->send();
```

## Start learning

### Installation

Run this from your project root in command line:

```
composer require laravelista/bard
```

### Documentation

- [Usage](https://github.com/laravelista/Bard/wiki/Usage)
- [Learn the API](https://github.com/laravelista/Bard/wiki/Learn-the-API)
- [Laravel + Bard](https://github.com/laravelista/Bard/wiki/Laravel-and-Bard)

#### Tutorials

- [Sitemap for better SEO](https://laravelista.com/lessons/sitemap-for-better-seo) 
- [Create a sitemap with Laravel and Bard](https://laravelista.com/posts/create-a-sitemap-with-laravel-and-bard)

![Bard](http://news.cdn.leagueoflegends.com/public/images/pages/2015/breveal/img/Promo_Bard_Reveal_Mask.png)
