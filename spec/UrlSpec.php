<?php namespace spec\Laravelista\Bard;

use DateTime;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UrlSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('http://acme.me');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Laravelista\Bard\Url');
    }

    public function it_sets_priority()
    {
        // Test all from 0.0 to 1.0
        for ($i = 0.0; $i <= 1; $i += 0.1) {
            $this->setPriority($i)->shouldReturn($this);
        }
    }

    public function it_cannot_set_priority()
    {
        $this->shouldThrow('Exception')->duringSetPriority(22);
        $this->shouldThrow('Exception')->duringSetPriority(1.1);
        $this->shouldThrow('Exception')->duringSetPriority(- 1);
    }

    public function it_sets_location()
    {
        $this->setLocation('http://acme.me')->shouldReturn($this);
    }

    public function it_sets_change_frequency()
    {
        // Test all valid values for change frequency field
        $validChangeFrequencyValues = [
            "always", "hourly", "daily", "weekly",
            "monthly", "yearly", "never"
        ];

        foreach ($validChangeFrequencyValues as $changeFrequency) {
            $this->setChangeFrequency($changeFrequency)->shouldReturn($this);
        }
    }

    public function it_cannot_set_change_frequency()
    {
        $this->shouldThrow('Exception')->duringSetChangeFrequency('from time to time');
    }

    public function it_sets_last_modification()
    {
        $this->setLastModification(new DateTime("2014-12-22"))->shouldReturn($this);
    }

    public function it_adds_a_translation()
    {
        $this->addTranslation('de', "http://acme.me/de")->shouldReturn($this);
    }
}
