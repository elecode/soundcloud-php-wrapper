<?php

namespace Elecode\SoundCloud\Api;

use Elecode\SoundCloud\Api;
use Elecode\SoundCloud\Storage\MemoryStorage;

class FakeApi implements Api
{
    private $dataSource;

    public static function withDataSource(MemoryStorage $dataSource)
    {
        $fakeApi = new FakeApi();

        $fakeApi->dataSource = $dataSource;

        return $fakeApi;
    }

    public function getDataSource()
    {
        return $this->dataSource;
    }
}
