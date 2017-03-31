<?php

namespace Application\Test\Behat\Context;

use Application\Test\Behat\Context\AbstractContext;
use Behat\Gherkin\Node\TableNode;
use Application\Helper\UrlHelper;

class PDFContext extends AbstractContext
{
    /**
     * @var string
     */
    private $url = '';

    /**
     * @var string
     */
    private $language = '';

    /**
     * @Given I do not add language in URL
     */
    public function iDoNotAddLanguageInUrl()
    {
        $this->iAddLanguageInUrl();
    }

    /**
     * @Given I add :language language in URL
     * @Given I add :language in URL
     * @Given I have opened CV in browser in :language
     */
    public function iAddLanguageInUrl(string $language = '')
    {
        $this->language = $language;
    }

    /**
     * @When I execute provided URL
     */
    public function iExecuteProvidedUrl()
    {
        $this->url = UrlHelper::getLanguageUrl($this->language);
    }

    /**
     * @Then I should get response with code :code
     */
    public function iShouldGetResponseWithCode(string $code)
    {
        $this->getSession()->visit($this->url);
        $this->assertSession()->statusCodeEquals($code);
    }

    /**
     * @Then I should get :locale translation for key :key
     * @Then I should get :locale for :key
     */
    public function iShouldGetTranslation(string $locale, string $key)
    {
        $this->setLocale($locale);

        $this->assertContains(
            $this->translate($key),
            $this->getPdfText(
                $this->getContent()
            )
        );
    }
    
    /**
     * @Then Document should contain URLs to different languages:
     */
    public function documentShouldContainUrlToDifferentLanguages(TableNode $languages)
    {
        $content = $this->getContent();
        
        $matches = [];
        
        foreach ($languages->getHash() as $row) {
            $url = UrlHelper::getLanguageUrl($row['language']);
            
            preg_match('~' . $url .'~', $content, $matches);
        
            $this->assertTrue(
                count($matches) > 0,
                sprintf(
                    "The url %s does not exist in document",
                    $url
                )
            );
        }
    }
    
    
    
//    /**
//     * @Given I have opened CV in browser in :arg1
//     */
//    public function iHaveOpenedCvInBrowserIn($arg1)
//    {
//        throw new PendingException();
//    }

    /**
     * @When I click on download link
     */
    public function iClickOnDownloadLink()
    {
        throw new PendingException();
    }

    /**
     * @Then I should get PDF file
     */
    public function iShouldGetPdfFile()
    {
        throw new PendingException();
    }

    /**
     * @Then It should contain :arg1 in :arg2
     */
    public function itShouldContainIn($arg1, $arg2)
    {
        throw new PendingException();
    }

    
    
    /**
     * @return string
     */
    private function getContent(): string
    {
        return $this->getSession()
            ->getPage()
            ->getContent();
    }
}
