Feature: Password authentication
  In order to consume SoundCloud api on behalf of my app account
  As an application developer
  I want to authenticate without a connect screen

  Background:
    Given I have an application with "client id" and "client secret"

  Scenario: authenticated user
    Given there is a user "php@soundcloud.com" with password "secret"
    When I do password authentication with "php@soundcloud.com" and "secret"
    Then I am authenticated to use an api

  Scenario: user with single track
    Given I am authenticated user "php@soundcloud.com" with password "secret"
    And I have a 314 seconds track "Oslo Metro"
    When I request list of my tracks
    Then my 314 seconds track "Oslo Metro" is in the list

    Scenario: user with two tracks
      Given I am authenticated user "php@soundcloud.com" with password "secret"
      And I have following tracks:
        | Title              | Duration |
        | Oslo Metro         | 314      |
        | London Underground | 315      |
      When I request list of my tracks
      Then I have 2 tracks in list
      And my 314 seconds track "Oslo Metro" is in the list
      And my 315 seconds track "London Underground" is in the list
