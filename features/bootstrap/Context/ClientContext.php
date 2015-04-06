<?php

namespace Context;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Elecode\SoundCloud\Api\FakeApiAdapter;
use Elecode\SoundCloud\SoundCloud;
use Elecode\SoundCloud\ValueObject\Track;

/**
 * Defines application features from the specific context.
 */
class ClientContext implements Context, SnippetAcceptingContext
{
    private $applicationClientId;
    private $applicationClientSecret;

    private $me;
    private $trackList = array();

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->api = new FakeApiAdapter();
        $this->soundCloudWrapper = SoundCloud::withApi($this->api);
    }

    /**
     * @Given I have an application with :clientId and :clientSecret
     */
    public function iHaveAnApplicationWith($clientId, $clientSecret)
    {
        $this->applicationClientId = $clientId;
        $this->applicationClientSecret = $clientSecret;
    }

    /**
     * @Given there is a user :arg1 with password :arg2
     */
    public function thereIsAUserWithPassword($username, $password)
    {
        $this->api->fakeUser($this->applicationClientId, $this->applicationClientSecret, $username, $password);
    }

    /**
     * @When I do password authentication with :username and :password
     */
    public function iDoPasswordAuthenticationWith($username, $password)
    {
        $this->soundCloudWrapper->authenticate(
            $this->applicationClientId,
            $this->applicationClientSecret,
            $username,
            $password
        );
    }

    /**
     * @Then I am authenticated to use an api
     */
    public function iAmAuthenticatedToUseAnApi()
    {
        expect($this->soundCloudWrapper->isAuthenticated())->toBe(true);
    }

    /**
     * @Given I am authenticated user :username with password :password
     */
    public function iAmAuthenticatedUserWithPassword($username, $password)
    {
        $this->thereIsAUserWithPassword($username, $password);
        $this->iDoPasswordAuthenticationWith($username, $password);
    }

    /**
     * @When I request my information
     */
    public function iRequestMyInformation()
    {
        $this->me = $this->soundCloudWrapper->getMe();
    }

    /**
     * @Then I have a user object with an id
     */
    public function iHaveAUserObjectWithAnId()
    {
        expect($this->me)->toHaveType('Elecode\SoundCloud\ValueObject\User');
        expect($this->me->getId() > 0)->toBe(true);
    }

    /**
     * @Given I have a track :arg1
     */
    public function iHaveATrack($title)
    {
        $me = $this->soundCloudWrapper->getMe();
        $this->api->fakeTracks($me->getId(), [['title' => $title]]);
    }

    /**
     * @When I request list of my tracks
     */
    public function iRequestListOfMyTracks()
    {
        $me = $this->soundCloudWrapper->getMe();
        $this->trackList = $this->soundCloudWrapper->getTracksFromUser($me);
    }

    /**
     * @Then my track :arg1 is in the list
     */
    public function iMySecondsTrackIsInTheList($title)
    {
        /** @var Track $track */
        foreach ($this->trackList as $track) {
            if ($track->getTitle() == $title) {
                return;
            }
        }
        throw new \Exception(sprintf("Track '%s' was not found", $title));
    }

    /**
     * @Given I have following tracks:
     */
    public function iHaveFollowingTracks(TableNode $table)
    {
        $tracks = [];
        foreach ($table->getHash() as $row) {
            $tracks[] = [
                'title' => $row['Title'],
            ];
        }
        $me = $this->soundCloudWrapper->getMe();
        $this->api->fakeTracks($me->getId(), $tracks);
    }

    /**
     * @Then I have :arg1 tracks in list
     */
    public function iHaveTracksInList($arg1)
    {
        expect(count($this->trackList))->toBe((int)$arg1);
    }
}
