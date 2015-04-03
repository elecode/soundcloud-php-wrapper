<?php

namespace spec\Elecode\SoundCloud\Api;

use Buzz\Browser;
use Buzz\Message\MessageInterface;
use Buzz\Test\Message\Message;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BuzzAdapterSpec extends ObjectBehavior
{
    function let(Browser $buzzBrowser)
    {
        $this->beConstructedWith($buzzBrowser);
    }

    function it_is_api_adapter()
    {
        $this->shouldHaveType('Elecode\SoundCloud\Api\ApiAdapter');
    }

    function it_makes_a_get_request_without_any_parameters_via_buzz_browser(Browser $buzzBrowser)
    {
        $this->get('/sample/url');

        $buzzBrowser->get(
            'https://api.soundcloud.com/sample/url',
            ['Content-length: 0']
        )->shouldHaveBeenCalled();
    }

    function it_makes_a_get_requests_with_few_parameters_via_buzz_browser(Browser $buzzBrowser)
    {
        $this->get('/sample/url', ['data' => 'value', 'something' => 'more']);

        $buzzBrowser->get(
            'https://api.soundcloud.com/sample/url?data=value&something=more',
            ['Content-length: 0']
        )->shouldHaveBeenCalled();
    }

    function it_transform_a_string_json_from_buzz_browser_get_response_to_a_php_array(
        Browser $buzzBrowser,
        MessageInterface $buzzResponse
    )
    {
        $buzzResponse->getContent()->willReturn('{"error":"invalid_client"}');
        $buzzBrowser->get(Argument::any(), Argument::any())->willReturn($buzzResponse);
        $this->get('/sample/url')->shouldReturn(
            [
                'error' => 'invalid_client'
            ]
        );
    }

    function it_makes_a_post_request_via_buzz_browser(Browser $buzzBrowser)
    {
        $this->post('/sample/url');

        $buzzBrowser->post(
            'https://api.soundcloud.com/sample/url',
            ['Content-length: 0'],
            ''
        )->shouldHaveBeenCalled();
    }

    function it_transform_a_string_json_from_buzz_browser_post_response_to_a_php_array(
        Browser $buzzBrowser,
        MessageInterface $buzzResponse
    )
    {
        $buzzResponse->getContent()->willReturn('{"type": "track", "user": { "type": "user", "id":1234 } }');
        $buzzBrowser->post(Argument::any(), Argument::any(), Argument::any())->willReturn($buzzResponse);

        $this->post('/sample/url')->shouldReturn(
            [
                'type' => 'track',
                'user' => [
                    'type' => 'user',
                    'id' => 1234
                ]
            ]
        );
    }
}
