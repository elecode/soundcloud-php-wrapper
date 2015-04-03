<?php

namespace Elecode\SoundCloud;

class SoundCloud
{
    private $api;

    public static function withApi(Api $api)
    {
        $soundCloud = new SoundCloud();

        $soundCloud->api = $api;

        return $soundCloud;
    }

    public function getApi()
    {
        return $this->api;
    }
}
