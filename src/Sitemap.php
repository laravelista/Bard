<?php namespace Laravelista\Bard;

use Sabre\Xml\Writer;
use Symfony\Component\HttpFoundation\Response;

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
    public function generate()
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
     * @return Response
     */
    public function render()
    {
        return new Response($this->generate(), Response::HTTP_OK, ['Content-Type' => 'text/xml']);
    }


    /**
     * @param $location
     * @param null $priority
     * @param null $changeFrequency
     * @param null $lastModification
     * @param array $translations
     * @return Url
     */
    public function add($location, $priority = null, $changeFrequency = null, $lastModification = null, array $translations = [])
    {
        $this->urls[] = $url = new Url($location, $priority, $changeFrequency, $lastModification, $translations);

        return $url;
    }
}
