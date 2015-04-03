<?php

namespace spec\Elecode\SoundCloud\ValueObject;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TrackSpec extends ObjectBehavior
{
    function it_has_date_duration_title_and_secret_token()
    {
        $this->beConstructedThrough(
            'withIdDateDurationTitleAndSecret',
            [
                123456789,
                '2015/03/28 21:39:51',
                314,
                "Sample Track",
                "s-WdV4l"
            ]
        );

        $this->getId()->shouldReturn(123456789);
        $this->getDate()->shouldReturn('2015-03-28 21:39:51');
        $this->getDuration()->shouldReturn(314);
        $this->getTitle()->shouldReturn("Sample Track");
        $this->getSecretToken()->shouldReturn("s-WdV4l");
    }
}
