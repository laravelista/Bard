<?php namespace Laravelista\Bard;

use Sabre\Xml\Writer;

class Sitemap {

    protected $urls = [];

    protected $writer;

    /**
     * @param Writer $writer
     */
    function __construct(Writer $writer)
    {
        $this->writer = $writer;
    }

    /**
     * @return string
     */
    public function render()
    {
        $this->writer->openMemory();

        $this->writer->startDocument("1.0", 'UTF-8');

        $this->writer->namespaceMap = [
            'http://www.sitemaps.org/schemas/sitemap/0.9' => ''
        ];

        $this->writer->startElement('urlset');

        foreach ($this->urls as $url)
        {
            $this->writer->write([
                'url' => $url
            ]);
        }

        $this->writer->endElement();

        return $this->writer->outputMemory();
    }

    /**
     * @param $location
     * @param $priority
     * @param $changeFrequency
     * @param null $lastModification
     * @param array $translations
     * @return $this
     */
    public function add($location, $priority = null, $changeFrequency = null, $lastModification = null, array $translations = [])
    {
        $this->urls[] = new Url($location, $priority, $changeFrequency, $lastModification, $translations);

        return $this;
    }
}
