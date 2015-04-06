Feature: User tracks
  In order display track information on my website
  As an application developer
  I need to have a list of my tracks

  Background:
    Given I have an application with "client id" and "client secret"

  Scenario: user with single track
    Given I am authenticated user "php@soundcloud.com" with password "secret"
    And I have a track "Oslo Metro"
    When I request list of my tracks
    Then my track "Oslo Metro" is in the list

    Scenario: user with two tracks
      Given I am authenticated user "php@soundcloud.com" with password "secret"
      And I have following tracks:
        | Title              |
        | Oslo Metro         |
        | London Underground |
      When I request list of my tracks
      Then I have 2 tracks in list
      And my track "Oslo Metro" is in the list
      And my track "London Underground" is in the list
