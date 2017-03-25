Feature: CV download
  In order to download pdf in proper language
  As a Head Hunter or HR worker
  I need to provide a link, click on download button
  And I should get the PDF file

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



