<?php

namespace Context;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Elecode\SoundCloud\Api\FakeApi;
use Elecode\SoundCloud\Domain\Application;
use Elecode\SoundCloud\Domain\User;
use Elecode\SoundCloud\SoundCloud;
use Elecode\SoundCloud\Storage\MemoryStorage;

/**
 * Defines application features from the specific context.
 */
class ClientContext implements Context, SnippetAcceptingContext
{
    private $applicationClientId;
    private $applicationClientSecret;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->dataSource = new MemoryStorage();
        $this->api = FakeApi::withDataSource($this->dataSource);
        $this->soundCloudWrapper = SoundCloud::withApi($this->api);
    }

    /**
     * @Given there is an application with :clientId and :clientSecret
     */
    public function thereIsAnApplicationWithAnd($clientId, $clientSecret)
    {
        $application = Application::withIdAndSecret($clientId, $clientSecret);
        $this->dataSource->storeApplication($application);
    }

    /**
     * @Given there is a user :arg1 with password :arg2
     */
    public function thereIsAUserWithPassword($username, $password)
    {
        $user = User::withUsernameAndPassword($username, $password);
        $this->api->defineRoute(
            '/oauth2/token',
            [
                'client_id' => $this->applicationClientId,
                'client_secret' => $this->applicationClientSecret,
                'username' => $username,
                'password' => $password,
                'grant_type' => 'password'
            ],
            '{ "access_token":"'
        )
    }

    /**
     * @When I do password authentication with :arg1, :arg2, :arg3 and :arg4
     */
    public function iDoPasswordAuthenticationWithAnd($arg1, $arg2, $arg3, $arg4)
    {
        throw new PendingException();
    }

    /**
     * @Then I receive an authentication token
     */
    public function iReceiveAnAuthenticationToken()
    {
        throw new PendingException();
    }
}
