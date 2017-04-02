Feature: CV display
  In order to display pdf in proper language
  As a Head Hunter or HR worker
  I need to provide a default link
  Then I should get CV with default language
  Or I should select a language
  Then I should get CV in selected language

  Scenario: Trying to open CV in browser with default url
    Given I do not add language in URL
    When I execute provided URL
    Then I should get response with code "200"
    And I should get "en_GB" translation for key "cv-mainHeader-speciality"
    And Document should contain URLs to different languages:
      | language |
      | en       |
      | de       |
      | pl       |

  Scenario Outline: Trying to open CV in browser with selected language
    Given I add <language> in URL
    When I execute provided URL
    Then I should get response with code "200"
    And I should get <locale> for <key>

    Examples:
      | language | locale  | key                                 |
      | "en"     | "en_GB" | "cv-mainHeader-speciality"          |
      | "pl"     | "pl_PL" | "cv-technicalSkills-sectionTitle"   |
      | "de"     | "de_DE" | "cv-employmentHistory-sectionTitle" |
      | "xx"     | "xx_XX" | "cv-careerGoals-sectionTitle"       |

