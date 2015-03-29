<?php namespace Laravelista\Bard;

use Exception;
use Laravelista\Bard\Exceptions\ValidationException;
use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class Url implements XmlSerializable {

    protected $location;

    protected $priority;

    protected $changeFrequency;

    protected $validChangeFrequencyValues = [
        "always", "hourly", "daily", "weekly",
        "monthly", "yearly", "never"
    ];

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
        $this->setLocation($location);
        if ( ! is_null($priority)) $this->setPriority($priority);
        if ( ! is_null($changeFrequency)) $this->setChangeFrequency($changeFrequency);
        if ( ! is_null($lastModification)) $this->setLastModification($lastModification);
        if ( ! is_null($translations)) $this->setTranslations($translations);
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

    /**
     * @param mixed $location
     * @return bool
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return true;
    }

    /**
     * @param array $translations
     * @return bool
     * @throws ValidationException
     */
    public function setTranslations(array $translations)
    {
        foreach ($translations as $translation)
        {
            if ( ! is_array($translation))
            {
                throw new ValidationException('Translation must be an array.');
            }

            $this->validateTranslation($translation);
        }

        $this->translations = $translations;

        return true;
    }

    /**
     * Adds a translation to property translations.
     * @return bool
     * @throws Exception
     * @throws ValidationException
     */
    public function addTranslation()
    {
        $params = func_get_args();

        if (is_array($params[0]))
        {
            $translation = $params[0];

            $this->validateTranslation($translation);

            $this->translations[] = $translation;

            return true;
        }

        if (count($params) != 2)
        {
            throw new Exception('You must pass array as first parameter or (hreflang and href)');
        }

        $hreflang = $params[0];
        $href = $params[1];

        $this->translations[] = [
            'hreflang' => $hreflang,
            'href'     => $href
        ];

        return true;
    }

    /**
     * @param $translation
     * @throws ValidationException
     */
    private function validateTranslation(array $translation)
    {
        if ( ! array_key_exists('hreflang', $translation) || ! array_key_exists('href', $translation))
        {
            throw new ValidationException('Translation must be an array with hreflang and href keys.');
        }
    }

    /**
     * @param null $lastModification
     * @return bool
     */
    public function setLastModification($lastModification)
    {
        // TODO: Validate and convert date
        $this->lastModification = $lastModification;

        return true;
    }

    /**
     * @return array
     */
    public function getValidChangeFrequencyValues()
    {
        return $this->validChangeFrequencyValues;
    }

    /**
     * @param null $changeFrequency
     * @return bool
     * @throws ValidationException
     */
    public function setChangeFrequency($changeFrequency)
    {
        if ( ! in_array($changeFrequency, $this->getValidChangeFrequencyValues()))
        {
            throw new ValidationException('Change frequency supports only: always, hourly, daily, weekly, monthly, yearly and never values.');
        }

        $this->changeFrequency = $changeFrequency;

        return true;
    }

    /**
     * @param null $priority
     * @return bool
     * @throws ValidationException
     */
    public function setPriority($priority)
    {
        if ( ! (is_float($priority) && $priority >= 0 && $priority <= 1))
        {
            throw new ValidationException('Priority must be >=0.0 and <=1.0');
        }

        $this->priority = number_format($priority, 1);

        return true;
    }

}
