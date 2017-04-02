<?php

namespace Application\Test\Behat\Context;

use Application\test\behat\context\AbstractContext;
use Behat\Gherkin\Node\TableNode;
use Application\Helper\UrlHelper;
use Application\Helper\ServerResolver;

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
        ServerResolver::setServerName($this->host);

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
     * @Then It should contain :key in :locale
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

    /**
     * @when I click on download link
     */
    public function iClickOnDownloadLink()
    {
        $this->iExecuteProvidedUrl();

        $this->url = $this->url . '/download';
    }

    /**
     * @Then I should get PDF file
     */
    public function iShouldGetPdfFile()
    {
        $this->getSession()->visit($this->url);

        $headers = $this->getSession()->getResponseHeaders();

        $contentDisposition = 'Content-Disposition';

        $this->assertArrayHasKey($contentDisposition, $headers);

        foreach ($headers[$contentDisposition] as $headerData) {
            $this->assertContains('attachment', $headerData);
        }
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
