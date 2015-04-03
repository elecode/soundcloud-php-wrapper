<?php

namespace Elecode\SoundCloud\ValueObject;

class Track
{
    private $id;
    private $date;
    private $duration;
    private $title;
    private $secret;

    public static function withIdDateDurationTitleAndSecret($argument1, $argument2, $argument3, $argument4, $argument5)
    {
        $track = new Track();

        $track->id = $argument1;
        $track->date = new \DateTime($argument2);
        $track->duration = $argument3;
        $track->title = $argument4;
        $track->secret = $argument5;

        return $track;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDate()
    {
        return $this->date->format('Y-m-d H:i:s');
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getSecretToken()
    {
        return $this->secret;
    }
}
