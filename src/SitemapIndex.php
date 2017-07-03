<?php

namespace Laravelista\Bard;

use Laravelista\Bard\Interfaces\Generatable;
use Laravelista\Bard\Interfaces\Renderable;
use Laravelista\Bard\Traits\Renderer;
use Sabre\Xml\Writer;

class SitemapIndex implements Renderable, Generatable
{
    use Renderer;

    protected $sitemaps = [];

    protected $writer;

    /**
     * @param Writer $writer
     */
    public function __construct(Writer $writer)
    {
        $this->writer = $writer;
    }

    /**
     * @return string
     */
    public function generate()
    {
        $this->writer->openMemory();

        $this->writer->startDocument("1.0", 'UTF-8');

        $this->writer->namespaceMap = [
            'http://www.sitemaps.org/schemas/sitemap/0.9' => ''
        ];

        $this->writer->startElement('sitemapindex');

        foreach ($this->sitemaps as $sitemap) {
            $this->writer->write([
                'sitemap' => $sitemap
            ]);
        }

        $this->writer->endElement();

        return $this->writer->outputMemory();
    }

    /**
     * @param $location
     * @return Sitemap
     */
    public function addSitemap($location)
    {
        $this->sitemaps[] = $sitemap = new Sitemap($location);

        return $sitemap;
    }
}
