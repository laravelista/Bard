<?php namespace spec\Laravelista\Bard;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sabre\Xml\Writer;

class SitemapSpec extends ObjectBehavior {

    function let()
    {
        $this->beConstructedWith(new Writer);
    }

    function it_adds_url_to_sitemap()
    {
        $this->add('/')->shouldReturn($this);
    }

    function it_renders_sitemap_in_xml()
    {
        $this->add('/', '1.0', 'monthly', null, [['hreflang' => 'en', 'href' => "/en"]]);

        var_dump($this->render()->getWrappedObject());

        $this->render()->shouldReturn('<urlset><url><loc>/</loc><priority>1.0</priority><changeFrequency>monthly</changeFrequency><xhtml:link rel="alternate" hreflang="en" href="/en"/></url></urlset>');
    }
}
