<?php

namespace spec\Elecode\SoundCloud\Domain;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ApplicationSpec extends ObjectBehavior
{
    function it_has_id_and_secret()
    {
        $this->beConstructedThrough('withIdAndSecret', ['some_id', 'some_secret']);
        $this->getId()->shouldReturn('some_id');
        $this->getSecret()->shouldReturn('some_secret');
    }
}
