<?php namespace Laravelista\Bard;

use Laravelista\Bard\Traits\Common;
use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class Sitemap implements XmlSerializable
{
    use Common;

    protected $location;

    protected $lastmod;

    /**
     * @param $location
     */
    public function __construct($location)
    {
        $this->setLocation($location);
    }

    /**
     * @param Writer $writer
     * @return void
     */
    public function xmlSerialize(Writer $writer)
    {
        $writer->write([
            'loc' => $this->location,
        ]);

        $this->add($writer, ['lastmod']);
    }
}
