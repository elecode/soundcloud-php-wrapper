<?php

namespace spec\Elecode\SoundCloud;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserSpec extends ObjectBehavior
{
    function it_has_id()
    {
        $id = 123456789;
        $this->beConstructedThrough('withId', [$id]);
        $this->getId()->shouldReturn($id);
    }
}
