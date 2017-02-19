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
use Application\Normalization\NormalizedLocalizationService;

class CurriculumVitaeBuilder extends AbstractBuilder
{
    /**
     * @var TcpdfInterface|CurriculumVitae
     */
    private $cv = null;
    
    /**
     * @var NormalizedLocalizationService
     */
    private $normalizedLocalization;
    
    public function __construct(NormalizedLocalizationService $normalizedLocalization)
    {
        $this->normalizedLocalization = $normalizedLocalization;
        
        $this->cv = new CurriculumVitae();
    }

    /**
     * {@inheritDoc}
     */
    public function render() {
        return $this->cv->renderPdf();
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
