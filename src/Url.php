<?php namespace Laravelista\Bard;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class Url implements XmlSerializable {

    protected $location;

    protected $priority;

    protected $changeFrequency;

    protected $lastModification;

    protected $translations = [];

    /**
     * @param $location
     * @param $priority
     * @param $changeFrequency
     * @param null $lastModification
     * @param array $translations
     */
    function __construct($location, $priority = null, $changeFrequency = null, $lastModification = null, array $translations = [])
    {
        $this->location = $location;
        $this->priority = $priority;
        $this->changeFrequency = $changeFrequency;
        $this->lastModification = $lastModification;
        $this->translations = $translations;
    }

    /**
     *
     * @param Writer $writer
     * @return void
     */
    function xmlSerialize(Writer $writer)
    {
        // This is required
        $writer->write([
            'loc' => $this->location,
        ]);

        // This is optional
        $this->add($writer, ['priority', 'changeFrequency', 'lastModification']);

        $this->addTranslations($writer);
    }

    /**
     * @param Writer $writer
     */
    private function addTranslations(Writer $writer)
    {
        foreach ($this->translations as $translation)
        {
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
     * Adds property from properties to url if it is not null.
     *
     * @param Writer $writer
     * @param array $properties
     */
    private function add(Writer $writer, array $properties)
    {
        foreach ($properties as $property)
        {
            if ( ! is_null($this->$property))
                $writer->write([$property => $this->$property]);
        }
    }
}
