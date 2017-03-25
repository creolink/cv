<?php

namespace Application\Test\Behat\Context;

use SGH\PdfBox\PdfBox;
use Behat\Testwork\Hook\Scope\BeforeSuiteScope;
use Application\Normalization\NormalizedTranslationService;
use Zend\Mvc\I18n\Translator;
use Zend\I18n\Translator\Translator as I18nTranslator;
use Behatch\Context\BaseContext;

class AbstractContext extends BaseContext
{
    /**
     * @var NormalizedTranslationService
     */
    private static $translator;

    /**
     * @BeforeSuite
     */
    public static function initTranslator()
    {
        self::setTranslator();
    }

    /**
     * @param string $content
     * @return string
     */
    protected function getPdfText(string $content): string
    {
        return $this->getPdfBox()
            ->textFromPdfStream($content);
    }

    /**
     * @param string $locale
     */
    protected function setLocale(string $locale)
    {
        self::$translator->setLocale($locale);
    }

    /**
     * @param string $key
     * @return string
     */
    protected function translate(string $key): string
    {
        return $this->getTranslator()
                ->translate($key);
    }

    /**
     * @return PdfBox
     */
    private function getPdfBox(): PdfBox
    {
        $pdfBox = new PdfBox();
        $pdfBox->setPathToPdfBox(
            realpath('') . '/config/pdfbox-app-2.0.5.jar'
        );

        return $pdfBox;
    }

    /**
     * Configures Translator
     */
    private static function setTranslator()
    {
        $translator = new Translator(
            new I18nTranslator()
        );
        $translator->addTranslationFilePattern('gettext', __DIR__ . '/../../../language/', '%s.mo');

        self::$translator = new NormalizedTranslationService($translator);
    }

    /**
     * @return NormalizedTranslationService
     */
    private function getTranslator():NormalizedTranslationService
    {
        return self::$translator;
    }
}
