<?php

namespace Elecode\SoundCloud\Storage;

use Elecode\SoundCloud\Domain\Application;

class MemoryStorage
{
    private $applications;

    public function storeApplication(Application $application)
    {
        $this->applications[] = $application;
    }

    public function getApplications()
    {
        return $this->applications;
    }
}
