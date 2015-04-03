Feature: Password authentication
  In order to consume SoundCloud api on behalf of my app account
  As an application developer
  I want to authenticate without a connect screen

  Scenario: authenticated user
    Given I have an application with "client id" and "client secret"
    And there is a user "php@soundcloud.com" with password "secret"
    When I do password authentication with "php@soundcloud.com" and "secret"
    Then I am authenticated to use an api
