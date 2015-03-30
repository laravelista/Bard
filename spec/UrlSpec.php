<?php namespace spec\Laravelista\Bard;

use DateTime;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UrlSpec extends ObjectBehavior {

    function let()
    {
        $this->beConstructedWith('http://acme.me');
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
        $this->setLastModification(new DateTime("2014-12-22"))->shouldReturn(true);
    }

    function it_sets_translations()
    {
        $translations = [
            [
                'hreflang' => 'en',
                'href'     => "http://acme.me/en"
            ],
            [
                'hreflang' => 'de',
                'href'     => "http://acme.me/de"
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
        $this->addTranslation('de', "http://acme.me/de")->shouldReturn(true);

        $translation = [
            'hreflang' => 'de',
            'href'     => "http://acme.me/de"
        ];

        $this->addTranslation($translation)->shouldReturn(true);
    }

    function it_cannot_add_a_translation()
    {
        $this->shouldThrow('Exception')->duringAddTranslation('de', "http://acme.me/de", "be");

        $this->shouldThrow('Laravelista\Bard\Exceptions\ValidationException')->duringAddTranslation(["bla"]);
    }
}
