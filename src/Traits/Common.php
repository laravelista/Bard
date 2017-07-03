<?php

namespace Laravelista\Bard\Traits;

use Carbon\Carbon;
use DateTime;
use Exception;
use Sabre\Xml\Writer;

trait Common
{
    /* protected $location; */

    /* protected $lastmod; */

    /**
     * @param $url
     * @throws Exception
     */
    public function setLocation($url)
    {
        $this->validateUrl($url);

        $this->location = $url;

        return $this;
    }


    /**
     * @param DateTime $lastModification
     */
    public function setLastModification(DateTime $lastModification)
    {
        $this->lastmod = Carbon::instance($lastModification)->toW3cString();

        return $this;
    }

    /**
     * Adds property from properties to url if it is not null.
     *
     * @param Writer $writer
     * @param array $properties
     */
    private function add(Writer $writer, array $properties)
    {
        foreach ($properties as $property) {
            if (! is_null($this->$property)) {
                $writer->write([$property => $this->$property]);
            }
        }
    }

    /**
     * @param $url
     * @throws ValidationException
     */
    private function validateUrl($url)
    {
        if (! filter_var($url, FILTER_VALIDATE_URL)) {
            throw new Exception('Not a valid URL');
        }
    }
}
