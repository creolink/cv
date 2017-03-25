Feature: CV display
  In order to display pdf in proper language
  As a Head Hunter or HR worker
  I need to provide a default link and I should select a language

  Scenario: Trying to open cv in browser with default url
    Given I should not provide language in url
    When I execute url
    Then I should get response with code "200"
    And I should get "en_GB" translation

  Scenario: Trying to open cv in browser with selected language
    Given I should provide "en" language in url
    When I execute url
    Then I should get response with code "200"
    And I should get "en_GB" translation