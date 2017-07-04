<?php

namespace Laravelista\Bard;

use Exception;
use Laravelista\Bard\Traits\Common;
use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class Url implements XmlSerializable
{
    use Common;

    protected $location;

    protected $priority;

    protected $changefreq;

    protected $lastmod;

    protected $translations = [];

    public function __construct($location)
    {
        $this->setLocation($location);
    }

    /**
     *
     * @param Writer $writer
     * @return void
     */
    public function xmlSerialize(Writer $writer)
    {
        $writer->write([
            'loc' => $this->location,
        ]);

        $this->add($writer, ['priority', 'changefreq', 'lastmod']);

        $this->addTranslations($writer);
    }

    /**
     * Used for serialization.
     *
     * @param Writer $writer
     */
    private function addTranslations(Writer $writer)
    {
        foreach ($this->translations as $translation) {
            $writer->write([
                [
                    'name'       => 'xhtml:link',
                    'attributes' => [
                        'rel'      => 'alternate',
                        'hreflang' => $translation['hreflang'],
                        'href'     => $translation['href']
                    ],
                    'value'      => null
                ]
            ]);
        }
    }

    /**
     * It adds a translation
     *
     * addTranslation('hr', 'http://domain.com/hr/contact');
     *
     * @param $locale
     * @param $url
     */
    public function addTranslation($locale, $url)
    {
        $this->validateUrl($url);

        $this->translations[] = [
            'hreflang' => $locale,
            'href'     => $url
        ];

        return $this;
    }

    /**
     * It sets change frequency.
     *
     * @param $changeFrequency
     * @throws Exception
     */
    public function setChangeFrequency($changeFrequency)
    {
        if (! in_array($changeFrequency, [
            "always", "hourly", "daily", "weekly",
            "monthly", "yearly", "never"
        ])) {
            throw new Exception('Change frequency not supported!');
        }

        $this->changefreq = $changeFrequency;

        return $this;
    }

    /**
     * It sets priority.
     *
     * @param $priority
     * @throws Exception
     */
    public function setPriority($priority)
    {
        if (! (is_float($priority) && $priority >= 0 && $priority <= 1)) {
            throw new Exception('Priority must be >=0.0 and <=1.0');
        }

        $this->priority = number_format($priority, 1);

        return $this;
    }
}
