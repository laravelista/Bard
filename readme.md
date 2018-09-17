# Bard

Bard is the simplest PHP Sitemap package, just add some URLs and you are ready to go.

[![Become a Patron](https://img.shields.io/badge/Becoma%20a-Patron-f96854.svg?style=for-the-badge)](https://www.patreon.com/shockmario)

**Abandoned!** I suggest using [`spatie/larevel-sitemap`](https://github.com/spatie/laravel-sitemap) instead. It is a much better package with automatic sitemap generation.

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

- [Bard 2.0 and Laravel](https://laravelista.com/lessons/bard-20-and-laravel)
- [Creating a Sitemap with Bard 2.0](https://laravelista.com/lessons/creating-a-sitemap-with-bard-20)
- [Sitemap for better SEO](https://laravelista.com/lessons/sitemap-for-better-seo) 
- [Create a sitemap with Laravel and Bard](https://laravelista.com/posts/create-a-sitemap-with-laravel-and-bard)

![Bard](http://news.cdn.leagueoflegends.com/public/images/pages/2015/breveal/img/Promo_Bard_Reveal_Mask.png)
