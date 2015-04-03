<?php

namespace spec\Elecode\SoundCloud\Api;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FakeApiAdapterSpec extends ObjectBehavior
{
    function it_is_an_api_adapter()
    {
        $this->shouldHaveType('Elecode\SoundCloud\Api\ApiAdapter');
    }

    function it_fakes_user_authentication_response()
    {
        $this->fakeUser('id', 'secret', 'username', 'password');

        $this->post(
            '/oauth2/token',
            [
                'client_id' => 'id',
                'client_secret' => 'secret',
                'username' => 'username',
                'password' => 'password',
                'grant_type' => 'password'
            ]
        )->shouldReturn(
            [
                'access_token' => '1-123456-123456789-abcd123456789'
            ]
        );
        
        $this->get('/me.json', ['oauth_token' => '1-123456-123456789-abcd123456789'])->shouldReturn(
            [
                "id" => 123456789
            ]
        );
    }

    function it_fakes_one_user_track()
    {
        $userId = 1234;
        $lengthInSeconds = 314000;
        $title = "Oslo Metro";
        $this->fakeTracks($userId, [['length' => $lengthInSeconds, 'title' => $title]]);

        $this->get("/users/{$userId}/tracks.json", ['oauth_token' => '1-123456-123456789-abcd123456789'])->shouldReturn(
            [
                [
                    "id" => 123456789,
                    "created_at" => "2015/03/28 21:39:51 +0000",
                    "duration" => $lengthInSeconds,
                    "tag_list" => "",
                    "genre" => "",
                    "title" => $title,
                    "description" => "",
                    "secret_token" => "s-WdV4l",
                    "secret_uri" => "https://api.soundcloud.com/tracks/123456789?secret_token=s-WdV4l"
                ]
            ]
        );
    }
}
