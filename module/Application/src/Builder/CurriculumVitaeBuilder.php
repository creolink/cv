<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Builder;

use Application\Builder\AbstractBuilder;
use Application\Builder\MainPage;
use Application\Builder\SecondPage;
use Application\Model\CurriculumVitae;
use Application\Model\TcpdfInterface;
use Application\Normalization\NormalizedTranslationService;
use Application\Normalization\NormalizedDateService;
use Application\Customizer\CustomizerService;

class CurriculumVitaeBuilder extends AbstractBuilder
{
    /**
     * @var TcpdfInterface|CurriculumVitae
     */
    private $cv = null;

    /**
     * @var NormalizedTranslationService
     */
    private $normalizedLocalization;

    /**
     * @var NormalizedDateService
     */
    private $normalizedDate;

    /**
     * @var CustomizerService
     */
    private $customizer;

    /**
     * @param NormalizedTranslationService $normalizedLocalization
     * @param NormalizedDateService $normalizedDate
     * @param CustomizerService $customizer
     */
    public function __construct(
        NormalizedTranslationService $normalizedLocalization,
        NormalizedDateService $normalizedDate,
        CustomizerService $customizer
    ) {
        $this->normalizedLocalization = $normalizedLocalization;
        $this->normalizedDate = $normalizedDate;
        $this->customizer = $customizer;

        $this->cv = new CurriculumVitae();
    }

    /**
     * {@inheritDoc}
     */
    public function render(): string
    {
        return $this->cv->outputPdf();
    }

    /**
     * Configures PDF document
     */
    public function configure()
    {
        $this->cv->configure();

        $this->cv->initFonts();

        $this->cv->setTranslator(
            $this->normalizedLocalization
        );

        $this->cv->setDateService(
            $this->normalizedDate
        );

        $this->cv->setCustomizer(
            $this->customizer
        );
    }

    /**
     * Generates main page
     */
    public function generateMainPage()
    {
        $page = new MainPage(
            $this->cv
        );

        $page->createPage();
    }

    /**
     * Generates second page
     */
    public function generateSecondPage()
    {
        $page = new SecondPage(
            $this->cv
        );

        $page->createPage();
    }
}
