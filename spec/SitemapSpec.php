<?php namespace spec\Laravelista\Bard;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sabre\Xml\Writer;

class SitemapSpec extends ObjectBehavior {

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
        $this->add('http://acme.me')->shouldHaveType('Laravelista\Bard\Url');
    }

    function it_generates_sitemap_xml_string()
    {
        $this->add('http://acme.me', 1.0, 'monthly', null, [['hreflang' => 'en', 'href' => "/en"]]);

        // TODO: This sometimes works and sometimes does not.
        /*$this->generate()->shouldBeLike('<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"><url><loc>/</loc><priority>1.0</priority><changeFrequency>monthly</changeFrequency><xhtml:link rel="alternate" hreflang="en" href="/en"/></url></urlset>');*/
    }

    function it_renders_sitemap_in_xml_response()
    {
        $this->add('http://acme.me', 1.0, 'monthly', null, [['hreflang' => 'en', 'href' => "/en"]]);

        //var_dump($this->render()->getWrappedObject()->getContent());
        //var_dump($this->render()->getWrappedObject());

        $this->render()->shouldHaveType('Symfony\Component\HttpFoundation\Response');
    }
}
