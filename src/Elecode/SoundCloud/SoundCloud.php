<?php

namespace Elecode\SoundCloud;

use Elecode\SoundCloud\Api\ApiAdapter;
use Elecode\SoundCloud\ValueObject\Track;
use Elecode\SoundCloud\ValueObject\User;

class SoundCloud
{
    /** @var ApiAdapter */
    private $api;
    private $accessToken = '';

    public static function withApi(ApiAdapter $api)
    {
        $soundCloud = new SoundCloud();

        $soundCloud->api = $api;

        return $soundCloud;
    }

    public function authenticate($clientId, $clientSecret, $username, $password)
    {
        $response = $this->api->post(
            '/oauth2/token',
            [
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'username' => $username,
                'password' => $password,
                'grant_type' => 'password',
            ]
        );
        if (array_key_exists('access_token', $response)) {
            $this->accessToken = $response['access_token'];
        }

        return $this->isAuthenticated();
    }

    public function isAuthenticated()
    {
        return strlen($this->accessToken) > 0;
    }

    public function getMe()
    {
        $userData = $this->api->get('/me.json', ['oauth_token' => $this->accessToken]);

        return User::withId($userData['id']);
    }

    public function getTracksFromUser(User $user)
    {
        $tracksData = $this->api->get("/users/{$user->getId()}/tracks.json", ['oauth_token' => $this->accessToken]);
        $tracks = [];
        foreach ($tracksData as $trackData) {
            $tracks[] = Track::withIdTitleDescriptionAndSecret(
                $trackData['id'],
                $trackData['title'],
                $trackData['description'],
                $trackData['secret_token']
            );
        }

        return $tracks;
    }
}
