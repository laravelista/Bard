<?php namespace Laravelista\Bard;

use Laravelista\Bard\Traits\Common;
use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class Sitemap implements XmlSerializable {

    use Common;

    protected $location;

    protected $lastmod;

    function __construct($location, $lastModification = null)
    {
        $this->setLocation($location);
        if ( ! is_null($lastModification)) $this->setLastModification($lastModification);
    }

    /**
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
        $this->add($writer, ['lastmod']);
    }
}
