<?php

namespace Elecode\SoundCloud\Domain;

class Application
{
    private $id;
    private $secret;

    public static function withIdAndSecret($clientId, $clientSecret)
    {
        $application = new Application();

        $application->id = $clientId;
        $application->secret = $clientSecret;

        return $application;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSecret()
    {
        return $this->secret;
    }
}
