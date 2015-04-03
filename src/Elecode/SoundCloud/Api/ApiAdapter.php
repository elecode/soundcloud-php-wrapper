<?php

namespace Elecode\SoundCloud\Api;

interface ApiAdapter
{
    public function get($url, $parameters = array());
    public function post($url, $data = array());
}
