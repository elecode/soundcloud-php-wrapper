<?php

namespace Elecode\SoundCloud\Domain;

class User
{
    private $username;
    private $password;

    public static function withUsernameAndPassword($argument1, $argument2)
    {
        $user = new User();

        $user->username = $argument1;
        $user->password = $argument2;

        return $user;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }
}
