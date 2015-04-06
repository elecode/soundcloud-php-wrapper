<?php

namespace Elecode\SoundCloud\ValueObject;

class Track
{
    private $id;
    private $title;
    private $description;
    private $secret;

    public static function withIdTitleDescriptionAndSecret($id, $title, $description, $secret)
    {
        $track = new Track();

        $track->id = $id;
        $track->title = $title;
        $track->description = $description;
        $track->secret = $secret;

        return $track;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getSecretToken()
    {
        return $this->secret;
    }
}
