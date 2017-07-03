<?php

namespace spec\Laravelista\Bard;

use DateTime;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SitemapSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('http://acme.me/sitemap.xml');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Laravelista\Bard\Sitemap');
    }

    public function it_sets_location()
    {
        $this->setLocation('http://acme.me/sitemap.xml')->shouldReturn($this);
    }

    public function it_sets_last_modification()
    {
        $this->setLastModification(new DateTime("2014-12-22"))->shouldReturn($this);
    }
}
