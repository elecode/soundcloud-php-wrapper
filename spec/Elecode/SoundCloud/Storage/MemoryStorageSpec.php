<?php

namespace spec\Elecode\SoundCloud\Storage;

use Elecode\SoundCloud\Domain\Application;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MemoryStorageSpec extends ObjectBehavior
{
    function it_stores_one_application(Application $application)
    {
        $this->storeApplication($application);
        $this->getApplications()->shouldReturn(array($application));
    }
}
