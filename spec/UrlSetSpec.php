<?php namespace spec\Laravelista\Bard;

use Laravelista\Bard\Helpers\Matchers;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sabre\Xml\Writer;

class UrlSetSpec extends ObjectBehavior
{
    use Matchers;

    public function let()
    {
        $this->beConstructedWith(new Writer);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Laravelista\Bard\UrlSet');
    }

    public function it_adds_url_to_urlset()
    {
        $this->addUrl('http://acme.me')->shouldHaveType('Laravelista\Bard\Url');
    }

    public function it_generates_sitemap_xml_string()
    {
        $this->addUrl('http://acme.me', 1.0, 'monthly', null, [['hreflang' => 'en', 'href' => "http://acme.me/en"]]);

        $this->generate()->shouldBeValidXml();
    }

    public function it_renders_sitemap_in_xml_response()
    {
        $this->addUrl('http://acme.me', 1.0, 'monthly', null, [['hreflang' => 'en', 'href' => "http://acme.me/en"]]);

        //var_dump($this->render()->getWrappedObject()->getContent());

        $this->render()->shouldHaveType('Symfony\Component\HttpFoundation\Response');
    }
}
