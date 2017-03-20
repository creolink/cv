Feature: Product basket
  In order to display pdf
  As a Head Hunter
  I need to open proper language

  Scenario: Opening cv in english version
    Given Pdf should open in proper language
    When I select en flag
    Then I should have english translation
