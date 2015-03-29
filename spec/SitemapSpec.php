<?php namespace spec\Laravelista\Bard;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sabre\Xml\Writer;

class SitemapSpec extends ObjectBehavior {

    /**
     * getMatchers() should return an array with keys describing the expectations and values the closures
     * containing the logic of the expectations. The first parameter in the closure is the output
     * of the executed method.
     *
     * @return array
     */
    function getMatchers()
    {
        return [
            // Checks if the given $result is valid xml
            'beValidXml' => function ($result)
            {
                if ( ! simplexml_load_string($result)) return false;

                return true;
            }
        ];
    }

    function let()
    {
        $this->beConstructedWith(new Writer);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Laravelista\Bard\Sitemap');
    }

    function it_adds_url_to_sitemap()
    {
        $this->addUrl('http://acme.me')->shouldHaveType('Laravelista\Bard\Url');
    }

    function it_generates_sitemap_xml_string()
    {
        $this->addUrl('http://acme.me', 1.0, 'monthly', null, [['hreflang' => 'en', 'href' => "http://acme.me/en"]]);

        $this->generate()->shouldBeValidXml();
    }

    function it_renders_sitemap_in_xml_response()
    {
        $this->addUrl('http://acme.me', 1.0, 'monthly', null, [['hreflang' => 'en', 'href' => "http://acme.me/en"]]);

        //var_dump($this->render()->getWrappedObject()->getContent());

        $this->render()->shouldHaveType('Symfony\Component\HttpFoundation\Response');
    }
}
