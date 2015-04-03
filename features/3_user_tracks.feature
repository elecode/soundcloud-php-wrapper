Feature: User tracks
  In order display track information on my website
  As an application developer
  I need to have a list of my tracks

  Background:
    Given I have an application with "client id" and "client secret"

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
