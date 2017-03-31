<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Tester\Exception\PendingException;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }
    
    /**
     * @Given Pdf should open in proper language
     */
    public function pdfShouldOpenInProperLanguage()
    {
        throw new PendingException();
    }

    /**
     * @When I select en flag
     */
    public function iSelectEnFlag()
    {
        throw new PendingException();
    }

    /**
     * @Then I should have english translation
     */
    public function iShouldHaveEnglishTranslation()
    {
        throw new PendingException();
    }

}
