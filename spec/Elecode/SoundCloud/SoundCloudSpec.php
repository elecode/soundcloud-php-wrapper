<?php

namespace spec\Elecode\SoundCloud;

use Elecode\SoundCloud\Api;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SoundCloudSpec extends ObjectBehavior
{
    function it_has_api(Api $api)
    {
        $this->beConstructedThrough('withApi', [$api]);
        $this->getApi()->shouldReturn($api);
    }
}
