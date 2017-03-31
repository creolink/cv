Feature: CV download
  In order to download PDF in proper language
  As a Head Hunter or HR worker
  I need to provide a link in selected language
  And when I click on download button
  I should get the PDF file in selected language

  Scenario Outline: Trying to download CV in proper language
    Given I have opened CV in browser in <language>
    When I click on download link
    Then I should get PDF file
    And It should contain "cv-mainHeader-speciality" in <locale>

    Examples:
      | language | locale  |
      | "en"     | "en_GB" |
      | "pl"     | "pl_PL" |
      | "de"     | "de_DE" |

