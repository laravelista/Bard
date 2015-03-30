<?php namespace Laravelista\Bard\Traits;

use Carbon\Carbon;
use DateTime;
use Laravelista\Bard\Exceptions\ValidationException;
use Sabre\Xml\Writer;

trait Common {

    protected $location;

    protected $lastmod;

    /**
     * @param $url
     * @return bool
     * @throws ValidationException
     */
    public function setLocation($url)
    {
        $this->validateUrl($url);

        $this->location = $url;

        return true;
    }


    /**
     * @param DateTime $lastModification
     * @return bool
     */
    public function setLastModification(DateTime $lastModification)
    {
        $this->lastmod = Carbon::instance($lastModification)->toW3cString();

        return true;
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
     * @param $url
     * @throws ValidationException
     */
    private function validateUrl($url)
    {
        if ( ! filter_var($url, FILTER_VALIDATE_URL))
        {
            throw new ValidationException('Not a valid URL');
        }
    }

}