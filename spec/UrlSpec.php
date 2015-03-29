<?php namespace spec\Laravelista\Bard;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UrlSpec extends ObjectBehavior {

    function let()
    {
        $this->beConstructedWith('/test');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Laravelista\Bard\Url');
    }

    function it_sets_priority()
    {
        // Test all from 0.0 to 1.0
        for ($i = 0.0; $i <= 1; $i += 0.1)
        {
            $this->setPriority($i)->shouldReturn(true);
        }
    }

    function it_cannot_set_priority()
    {
        $this->shouldThrow('Laravelista\Bard\Exceptions\ValidationException')->duringSetPriority(22);
        $this->shouldThrow('Laravelista\Bard\Exceptions\ValidationException')->duringSetPriority(1.1);
        $this->shouldThrow('Laravelista\Bard\Exceptions\ValidationException')->duringSetPriority(- 1);
    }

    function it_sets_location()
    {
        $this->setLocation('http://acme.me')->shouldReturn(true);
    }

    function it_sets_change_frequency()
    {
        // Test all valid values for change frequency field
        foreach ($this->getValidChangeFrequencyValues() as $changeFrequency)
        {
            $this->setChangeFrequency($changeFrequency)->shouldReturn(true);
        }
    }

    function it_cannot_set_change_frequency()
    {
        $this->shouldThrow('Laravelista\Bard\Exceptions\ValidationException')->duringSetChangeFrequency('from time to time');
    }

    function it_sets_last_modification()
    {
        // TODO: Fix this to only allow correct date format
        $this->setLastModification('bla')->shouldReturn(true);
    }

    function it_sets_translations()
    {
        $translations = [
            [
                'hreflang' => 'en',
                'href'     => "/test/en"
            ],
            [
                'hreflang' => 'de',
                'href'     => "/test/de"
            ]
        ];

        $this->setTranslations($translations)->shouldReturn(true);
    }

    function it_cannot_set_translations()
    {
        $this->shouldThrow('Laravelista\Bard\Exceptions\ValidationException')->duringSetTranslations(["bla"]);
        $this->shouldThrow('Laravelista\Bard\Exceptions\ValidationException')->duringSetTranslations([['bla', 'bla']]);
    }

    function it_adds_a_translation()
    {
        $this->addTranslation('de', "/test/de")->shouldReturn(true);

        $translation = [
            'hreflang' => 'de',
            'href'     => "/test/de"
        ];

        $this->addTranslation($translation)->shouldReturn(true);
    }

    function it_cannot_add_a_translation()
    {
        $this->addTranslation('de', "/test/de", "be")->shouldReturn(false);

        $this->shouldThrow('Laravelista\Bard\Exceptions\ValidationException')->duringAddTranslation(["bla"]);
    }
}
