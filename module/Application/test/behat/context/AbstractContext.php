<?php

namespace Application\Test\Behat\Context;

use SGH\PdfBox\PdfBox;
use Behat\Testwork\Hook\Scope\BeforeSuiteScope;
use Application\Normalization\NormalizedTranslationService;
use Zend\Mvc\I18n\Translator;
use Zend\I18n\Translator\Translator as I18nTranslator;
use Behatch\Context\BaseContext;
use Zend\Mvc\Application;
use Zend\Stdlib\ArrayUtils;

abstract class AbstractContext extends BaseContext
{
    const CONFIG_PATH = __DIR__ . '/../../../../../config/';
    const APPLICATION_CONFIG = 'application.config.php';
    const DEVELOPMENT_CONFIG = 'development.config.php';

    const LANGUAGES_PATH = __DIR__ . '/../../../language/';
    const LANGUAGES_PATTERN = '%s.mo';
    const LANGUAGES_TYPE = 'gettext';

    /**
     * @var NormalizedTranslationService
     */
    private static $translator;

    /**
     * @var Application
     */
    private static $application;

    /**
     * @var string
     */
    protected $host;

    /**
     * @param string $host
     */
    public function __construct($host)
    {
        $this->host = $host;
    }

    /**
     * @BeforeSuite
     */
    public static function initTranslator()
    {
        self::setTranslator();
    }

    /**
     * @BeforeSuite
     */
    public static function initApplication()
    {
        self::setApplication();
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
     * @return Application
     */
    protected function getApplication():Application
    {
        return self::$application;
    }

    /**
     * @return array
     */
    private static function getConfig():array
    {
        $appConfig = require self::CONFIG_PATH . self::APPLICATION_CONFIG;

        if (file_exists(self::CONFIG_PATH . self::DEVELOPMENT_CONFIG)) {
            $appConfig = ArrayUtils::merge(
                $appConfig,
                require self::CONFIG_PATH . self::DEVELOPMENT_CONFIG
            );
        }

        return $appConfig;
    }

    /**
     * Sets application
     */
    private static function setApplication()
    {
        self::$application = Application::init(
            self::getConfig()
        );

        $events = self::$application->getEventManager();

        self::$application->getServiceManager()->get('SendResponseListener')->detach($events);
    }

    /**
     * Configures Translator
     */
    private static function setTranslator()
    {
        $translator = new Translator(
            new I18nTranslator()
        );

        $translator->addTranslationFilePattern(
            self::LANGUAGES_TYPE,
            self::LANGUAGES_PATH,
            self::LANGUAGES_PATTERN
        );

        self::$translator = new NormalizedTranslationService($translator);
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
     * @return NormalizedTranslationService
     */
    private function getTranslator():NormalizedTranslationService
    {
        return self::$translator;
    }
}
