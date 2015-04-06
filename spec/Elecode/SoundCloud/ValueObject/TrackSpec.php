<?php

namespace spec\Elecode\SoundCloud\ValueObject;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TrackSpec extends ObjectBehavior
{
    function it_has_date_duration_title_and_secret_token()
    {
        $this->beConstructedThrough(
            'withIdTitleDescriptionAndSecret',
            [
                123456789,
                'Sample Title',
                'Sample Description',
                's-WdV4l'
            ]
        );

        $this->getId()->shouldReturn(123456789);
        $this->getTitle()->shouldReturn('Sample Title');
        $this->getDescription()->shouldReturn('Sample Description');
        $this->getSecretToken()->shouldReturn('s-WdV4l');
    }
}
