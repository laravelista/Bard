<?php namespace spec\Laravelista\Bard;

use Carbon\Carbon;
use Laravelista\Bard\Helpers\Matchers;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sabre\Xml\Writer;

class SitemapIndexSpec extends ObjectBehavior {

    use Matchers;

    function let()
    {
        $this->beConstructedWith(new Writer);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Laravelista\Bard\SitemapIndex');
    }

    function it_adds_sitemap_to_sitemap_index()
    {
        $this->addSitemap('http://acme.me/sitemap.xml')->shouldHaveType('Laravelista\Bard\Sitemap');
    }

    function it_generates_sitemap_index_xml_string()
    {
        $this->addSitemap('http://acme.me/sitemap.xml', Carbon::now());

        $this->generate()->shouldBeValidXml();
    }

    function it_renders_sitemap_index_in_xml_response()
    {
        $this->addSitemap('http://acme.me/sitemap.xml', Carbon::now());

        //var_dump($this->render()->getWrappedObject()->getContent());

        $this->render()->shouldHaveType('Symfony\Component\HttpFoundation\Response');
    }

}
