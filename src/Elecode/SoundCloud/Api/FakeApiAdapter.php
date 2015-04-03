<?php

namespace Elecode\SoundCloud\Api;

class FakeApiAdapter implements ApiAdapter
{
    private $fakeGetResponses = array();
    private $fakePostResponses = array();

    public function get($url, $parameters = array())
    {
        $key = $this->getFakeResponseKey($url, $parameters);
        if (array_key_exists($key, $this->fakeGetResponses)) {
            return $this->fakeGetResponses[$key];
        }
    }

    public function post($url, $data = array())
    {
        $key = $this->getFakeResponseKey($url, $data);
        if (array_key_exists($key, $this->fakePostResponses)) {
            return $this->fakePostResponses[$key];
        }
    }

    public function fakeUser($clientId, $clientSecret, $username, $password)
    {
        $this->fakePostResponse(
            '/oauth2/token',
            [
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'username' => $username,
                'password' => $password,
                'grant_type' => 'password',
            ],
            [
                'access_token' => '1-123456-123456789-abcd123456789',
            ]
        );

        $this->fakeGetResponse(
            '/me.json',
            ['oauth_token' => '1-123456-123456789-abcd123456789'],
            [
                'id' => 123456789,
            ]
        );
    }

    public function fakeTracks($userId, $tracks)
    {
        $tracksResponse = [];
        foreach ($tracks as $track) {
            $tracksResponse[] = [
                'id' => 123456789,
                'created_at' => '2015/03/28 21:39:51 +0000',
                'duration' => $track['length'],
                'tag_list' => '',
                'genre' => '',
                'title' => $track['title'],
                'description' => '',
                'secret_token' => 's-WdV4l',
                'secret_uri' => 'https://api.soundcloud.com/tracks/123456789?secret_token=s-WdV4l',
            ];
        }
        $this->fakeGetResponse(
            "/users/{$userId}/tracks.json",
            ['oauth_token' => '1-123456-123456789-abcd123456789'],
            $tracksResponse
        );
    }

    private function getFakeResponseKey($url, $parameters)
    {
        return sprintf('%s|%s', $url, json_encode($parameters));
    }

    private function fakeGetResponse($url, $parameters, $response)
    {
        $this->fakeGetResponses[$this->getFakeResponseKey($url, $parameters)] = $response;
    }

    private function fakePostResponse($url, $data, $response)
    {
        $this->fakePostResponses[$this->getFakeResponseKey($url, $data)] = $response;
    }
}
