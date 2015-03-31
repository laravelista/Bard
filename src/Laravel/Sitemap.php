<?php  namespace Laravelista\Bard\Laravel;

use Laravelista\Bard\UrlSet;

abstract class Sitemap extends UrlSet implements SitemapInterface {

    /**
     * Specify an array of route names that you want
     * to be included in your sitemap.
     * Example: home, contact, info, booking ...
     * @var array
     */
    protected $namedRoutes = [];

    /**
     * Specify an array of your app supported locales.
     * Example: en, de, it, hr ...
     *
     * @var array
     */
    protected $locales = [];

    /**
     * Add named routes listed in property $namedRoutes to Sitemap.
     */
    public function addNamedRoutes()
    {
        foreach ($this->namedRoutes as $routeName)
        {
            $this->addNamedRoute($routeName);
        }
    }

    /**
     * Use $this->addUrl() to add named route to sitemap.
     * You can also add translations and other properties
     * with the object returned from addUrl() method.
     * You will probably want to add translations.
     *
     * @param $routeName
     * @return mixed
     */
    abstract public function addNamedRoute($routeName);

    /**
     * Get array of translations for given route name.
     * Don't forget to specify locales property.
     *
     * @param $routeName
     * @return mixed
     */
    public function getNamedRouteTranslations($routeName)
    {
        $translations = [];

        foreach ($this->locales as $locale)
        {
            array_push($translations, $this->getNamedRouteTranslation($routeName, $locale));
        }

        return $translations;
    }

    /**
     * This method returns array with keys href and hreflang.
     *
     * @param $routeName
     * @param $locale
     * @return mixed
     */
    public function getNamedRouteTranslation($routeName, $locale)
    {
        return [
            'href'     => $this->getLocalizedUrlForRouteName($routeName, $locale),
            'hreflang' => $locale
        ];
    }

    /**
     * Implement your own way for getting localized route url.
     *
     * @param $routeName
     * @param $locale
     * @return mixed
     */
    abstract public function getLocalizedUrlForRouteName($routeName, $locale);
}