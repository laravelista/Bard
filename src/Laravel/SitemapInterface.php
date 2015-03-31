<?php namespace Laravelista\Bard\Laravel;

interface SitemapInterface {

    public function addNamedRoutes();

    public function addNamedRoute($routeName);

    public function getNamedRouteTranslations($routeName);

    public function getNamedRouteTranslation($routeName, $locale);

    public function getLocalizedUrlForRouteName($routeName, $locale);

}