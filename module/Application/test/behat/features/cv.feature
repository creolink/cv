Feature: CV display
  In order to display pdf in proper language
  As a Head Hunter or HR worker
  I need to provide a default link and I should select a language

  Scenario: Trying to open cv in browser with default url
    Given I should not add language in url
    When I execute provided url
    Then I should get response with code "200"
    And I should get "en_GB" translation for key "cv-mainHeader-speciality"

  Scenario: Trying to open cv in browser with selected language
    Given I should add "en" language in url
    When I execute provided url
    Then I should get response with code "200"
    And I should get "en_GB" translation for key "cv-mainHeader-speciality"



