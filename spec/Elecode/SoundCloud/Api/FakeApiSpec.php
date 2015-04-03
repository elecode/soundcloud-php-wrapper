<?php

namespace spec\Elecode\SoundCloud\Api;

use Elecode\SoundCloud\Storage\MemoryStorage;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FakeApiSpec extends ObjectBehavior
{
    function it_is_api()
    {
        $this->shouldHaveType('Elecode\SoundCloud\Api');
    }

    function it_has_data_source(MemoryStorage $dataSource)
    {
        $this->beConstructedThrough('withDataSource', [$dataSource]);
        $this->getDataSource()->shouldReturn($dataSource);
    }
}
