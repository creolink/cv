<?php

namespace Application\Test\Unit;

use Zend\Stdlib\ArrayUtils;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Zend\Mvc\I18n\Translator;
use Zend\I18n\Translator\Translator as I18nTranslator;
use Application\Normalization\NormalizedTranslationService;
use Application\Customizer\CustomizerService;

abstract class AbstractTest extends AbstractHttpControllerTestCase
{
    const CONFIG_PATH = __DIR__ . '/../../../../config/';
    const APPLICATION_CONFIG = 'application.config.php';
    const DEVELOPMENT_CONFIG = 'development.config.php';

    const LANGUAGES_PATH = __DIR__ . '/../../../language/';
    const LANGUAGES_PATTERN = '%s.mo';
    const LANGUAGES_TYPE = 'gettext';

    /**
     * @var NormalizedTranslationService
     */
    protected $translator;

    /**
     * Setup
     */
    public function setUp()
    {
        $this->setConfig();
        $this->setTranslator();

        parent::setUp();
    }

    /**
     * Sets application config
     */
    private function setConfig()
    {
        $configOverrides = [];

        $config = require self::CONFIG_PATH . self::APPLICATION_CONFIG;

        $this->setApplicationConfig(
            ArrayUtils::merge(
                $config,
                $configOverrides
            )
        );
    }

    /**
     * Configures Translator
     */
    private function setTranslator()
    {
        $translator = new Translator(
            new I18nTranslator()
        );

        $customizer = new CustomizerService();

        $translator->addTranslationFilePattern(
            self::LANGUAGES_TYPE,
            self::LANGUAGES_PATH,
            self::LANGUAGES_PATTERN
        );

        $this->translator = new NormalizedTranslationService($translator, $customizer);
    }
}
