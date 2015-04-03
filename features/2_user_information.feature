Feature: User information
  In order to get list of my tracks
  As an application developer
  I need to have my user id

  Scenario: id of myself
    Given I have an application with "client id" and "client secret"
    And I am authenticated user "php@soundcloud.com" with password "secret"
    When I request my information
    Then I have a user object with an id
