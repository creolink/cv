<?php

namespace Application\Test\Behat\Context;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\MinkExtension\Context\RawMinkContext;
use SGH\PdfBox\PdfBox;
use Zend\Mvc\Application;
use Behat\Testwork\Hook\Scope\BeforeSuiteScope;
use Application\Normalization\NormalizedTranslationService;
use Zend\Mvc\I18n\Translator;
use Behatch\Context\BaseContext;
use Application\Config\PdfConfig;

class PDFContext extends BaseContext
{
    /**
     * @var Application
     */
    private static $application = null;

    /**
     * @var string
     */
    private $url = '';

    /**
     * @var string
     */
    private $language = '';

    /**
     * @var NormalizedTranslationService
     */
    private static $translator;

    /**
     * Inits ZF3 application in tests
     *
     * @BeforeSuite
     */
    public static function initZendApplication()
    {
        self::setTranslator();
    }

    /**
     * @Given I should not provide language in url
     */
    public function iShouldNotProvideLanguageInUrl()
    {
        $this->iShouldProvideLanguageInUrl();
    }

    /**
     * @Given I should provide :language language in url
     */
    public function iShouldProvideLanguageInUrl($language = '')
    {
        $this->language = $language;
    }

    /**
     * @When I execute url
     */
    public function iExecuteUrl()
    {
        $this->url = PdfConfig::DOCUMENT_HOST;

        if (empty($this->language)) {
            $url = $this->language . '.' . $this->url;
        }

        $this->url = 'http://' . $this->url;
    }

    /**
     * @Then I should get response with code :code
     */
    public function iShouldGetResponseWithCode($code)
    {
        $this->getSession()->visit($this->url);
        $this->assertSession()->statusCodeEquals($code);

        $content = $this->getSession()->getPage()->getContent();

        //preg_match_all('/URI\(([^,]*?)\)\/S\/URI/', $content, $matches);
        //var_dump($matches); die();

        //var_dump(strstr($content, 'cv.creolink.pl')); die();

        //var_dump($content); die();

        $converter = new PdfBox();
        $converter->setPathToPdfBox(realpath('') . '/config/pdfbox-app-2.0.5.jar');

        $this->setLocale('en_GB');

        $this->assertContains(
            $this->getTranslator()
                ->translate('cv-personalData-workPlace'),
            $converter->textFromPdfStream($content)
        );
    }

    /**
     * @Then I should get :locale translation
     */
    public function iShouldGetTranslation($locale)
    {
        throw new PendingException();
    }

    private static function setTranslator()
    {
        $translator = new Translator();
        $translator->addTranslationFilePattern('gettext', __DIR__ . '/../../../language/', '%s.mo');

        self::$translator = new NormalizedTranslationService($translator);
    }

    private function getTranslator():NormalizedTranslationService
    {
        return self::$translator;
    }

    private function setLocale(string $locale)
    {
        self::$translator->setLocale($locale);
    }
}
