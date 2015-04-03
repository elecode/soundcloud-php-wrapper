<?php

namespace Elecode\SoundCloud\Api;

use Buzz\Browser;
use Buzz\Message\MessageInterface;

class BuzzAdapter implements ApiAdapter
{
    const BASE_URL = 'https://api.soundcloud.com';

    private $buzzBrowser;

    public function __construct(Browser $buzzBrowser = null)
    {
        if (!is_null($buzzBrowser)) {
            $this->buzzBrowser = $buzzBrowser;
        } else {
            $this->buzzBrowser = new Browser();
        }
    }

    public function get($url, $parameters = array())
    {
        $response = $this->buzzBrowser->get($this->getFullUrl($url, $parameters), $this->getHeaders());

        return $this->decodeJsonResponse($response);
    }

    public function post($url, $data = array())
    {
        $buzzContent = http_build_query($data);
        $response = $this->buzzBrowser->post($this->getFullUrl($url), $this->getHeaders($buzzContent), $buzzContent);

        return $this->decodeJsonResponse($response);
    }

    private function getFullUrl($path, $parameters = array())
    {
        $buzzUrl = self::BASE_URL.$path;
        if (count($parameters) > 0) {
            $buzzUrl .= '?'.http_build_query($parameters);
        }

        return $buzzUrl;
    }

    private function getHeaders($content = '')
    {
        return [
            sprintf('Content-length: %d', strlen($content)),
        ];
    }

    private function decodeJsonResponse($response)
    {
        if ($response instanceof MessageInterface) {
            return json_decode($response->getContent(), JSON_OBJECT_AS_ARRAY);
        }

        return [];
    }
}
