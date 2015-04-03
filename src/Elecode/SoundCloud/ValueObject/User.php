<?php

namespace Elecode\SoundCloud\ValueObject;

class User
{
    private $id;

    public static function withId($id)
    {
        $user = new User();

        $user->id = $id;

        return $user;
    }

    public function getId()
    {
        return $this->id;
    }
}
