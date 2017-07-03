<?php

namespace Laravelista\Bard;

use Laravelista\Bard\Interfaces\Renderable;
use Laravelista\Bard\Interfaces\Generatable;
use Laravelista\Bard\Traits\Renderer;
use Sabre\Xml\Writer;

class UrlSet implements Renderable, Generatable
{
    use Renderer;

    protected $urls = [];

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
            'http://www.sitemaps.org/schemas/sitemap/0.9' => '',
            'http://www.w3.org/1999/xhtml'                => 'xhtml'
        ];

        $this->writer->startElement('urlset');

        foreach ($this->urls as $url) {
            $this->writer->write([
                'url' => $url
            ]);
        }

        $this->writer->endElement();

        return $this->writer->outputMemory();
    }

    /**
     * It adds a URL.
     *
     * @param $location
     * @return Url
     */
    public function addUrl($location)
    {
        $this->urls[] = $url = new Url($location);

        return $url;
    }
}
