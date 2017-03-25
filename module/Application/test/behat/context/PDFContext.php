<?php

namespace Application\Test\Behat\Context;

use Application\Config\PdfConfig;
use Application\Test\Behat\Context\AbstractContext;

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
     * @Given I should not add language in url
     */
    public function iShouldNotAddLanguageInUrl()
    {
        $this->iShouldAddLanguageInUrl();
    }

    /**
     * @Given I should add :language language in url
     */
    public function iShouldAddLanguageInUrl(string $language = '')
    {
        $this->language = $language;
    }

    /**
     * @When I execute provided url
     */
    public function iExecuteProvidedUrl()
    {
        $url = PdfConfig::DOCUMENT_HOST;

        if ('' !== $this->language) {
            $url = $this->language . '.' . $url;
        }

        $this->url = 'http://' . $url;
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
     */
    public function iShouldGetTranslation(string $locale, string $key)
    {
        $content = $this->getSession()->getPage()->getContent();

        $this->setLocale($locale);

        $this->assertContains(
            $this->translate($key),
            $this->getPdfText($content)
        );
    }
}
