<?php

namespace spec\Elecode\SoundCloud\Domain;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserSpec extends ObjectBehavior
{
    function it_has_username_and_a_password()
    {
        $this->beConstructedThrough('withUsernameAndPassword', ['user', 'pass']);
        $this->getUsername()->shouldReturn('user');
        $this->getPassword()->shouldReturn('pass');
    }
}
