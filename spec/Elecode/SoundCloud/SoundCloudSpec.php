<?php

namespace spec\Elecode\SoundCloud;

use Elecode\SoundCloud\Api\ApiAdapter;
use Elecode\SoundCloud\Track;
use Elecode\SoundCloud\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SoundCloudSpec extends ObjectBehavior
{
    function let(ApiAdapter $api)
    {
        $this->beConstructedThrough('withApi', [$api]);
    }

    function it_is_not_authenticated_initially(ApiAdapter $api)
    {
        $this->beConstructedThrough('withApi', [$api]);
        $this->isAuthenticated()->shouldReturn(false);
    }

    function it_is_authenticated_when_api_returns_valid_auth_token(ApiAdapter $api)
    {
        $api->post('/oauth2/token', Argument::any())->willReturn(
            [
                "access_token" => "sample_token"
            ]
        );

        $this->authenticate('id', 'secret', 'user', 'pass')->shouldReturn(true);
        $this->isAuthenticated()->shouldReturn(true);
    }

    function it_is_not_authenticated_when_api_returns_an_error(ApiAdapter $api)
    {
        $api->post('/oauth2/token', Argument::any())->willReturn(
            [
                "error" => "invalid_client"
            ]
        );

        $this->authenticate('id', 'secret', 'user', 'pass')->shouldReturn(false);
        $this->isAuthenticated()->shouldReturn(false);
    }

    function it_returns_currently_authenticated_customer(ApiAdapter $api)
    {
        $api->get('/me.json', Argument::any())->willReturn(
            [
                "id" => 123456789
            ]
        );
        $me = $this->getMe();
        $me->shouldBeLike(User::withId(123456789));
    }

    function it_returns_tracks_list_from_user(ApiAdapter $api, User $user)
    {
        $user->getId()->willReturn(123);
        $api->get("/users/123/tracks.json", Argument::any())->willReturn(
            [
                [
                    "id" => 123456789,
                    "created_at" => "2015/03/28 21:39:51 +0000",
                    "duration" => 314,
                    "tag_list" => "",
                    "genre" => "",
                    "title" => "Sample Track",
                    "description" => "",
                    "secret_token" => "s-WdV4l",
                    "secret_uri" => "https://api.soundcloud.com/tracks/123456789?secret_token=s-WdV4l"
                ]
            ]
        );

        $tracks = $this->getTracksFromUser($user);
        $tracks->shouldBeLike(
            [
                Track::withIdDateDurationTitleAndSecret(
                    123456789,
                    '2015/03/28 21:39:51',
                    314,
                    "Sample Track",
                    "s-WdV4l"
                )
            ]
        );
    }
}
