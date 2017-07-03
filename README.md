# Bard

[![Build Status](https://travis-ci.org/laravelista/Bard.svg)](https://travis-ci.org/laravelista/Bard) [![Latest Stable Version](https://poser.pugx.org/laravelista/bard/v/stable.svg)](https://packagist.org/packages/laravelista/bard) [![Total Downloads](https://poser.pugx.org/laravelista/bard/downloads.svg)](https://packagist.org/packages/laravelista/bard) [![Latest Unstable Version](https://poser.pugx.org/laravelista/bard/v/unstable.svg)](https://packagist.org/packages/laravelista/bard) [![License](https://poser.pugx.org/laravelista/bard/license.svg)](https://packagist.org/packages/laravelista/bard) [![Join the chat at https://gitter.im/laravelista/Bard](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/laravelista/Bard?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

![Bard](http://news.cdn.leagueoflegends.com/public/images/pages/2015/breveal/img/Promo_Bard_Reveal_BardFloating.png)

Tired of unstable and bloated PHP sitemap packages?

**Look no more!**

Bard is the simplest PHP Sitemap package, just add some URLs and you are ready to go. Did I mention that *it supports multilingual locations aka hreflangs*.

## Syntax

```
$sitemap->addUrl('http://domain.com/contact')
    ->setPriority(0.8)
    ->setChangeFrequency('hourly')
    ->setLastModification(Carbon::now())
    ->addTranslation('hr', 'http://domain.com/hr/contact');
```

## List of all poems

- [Install me gently](https://github.com/laravelista/Bard/wiki/Installation)
- [Let me show you how to use me](https://github.com/laravelista/Bard/wiki/Usage)
- [Learn the API](https://github.com/laravelista/Bard/wiki/Learn-the-API)
- [Laravel + Bard](https://github.com/laravelista/Bard/wiki/Laravel-and-Bard)

![Bard](http://news.cdn.leagueoflegends.com/public/images/pages/2015/breveal/img/Promo_Bard_Reveal_Mask.png)
