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

class CurriculumVitaeBuilder extends AbstractBuilder
{
    /**
     * @var TcpdfInterface
     */
    private $cv = null;
    
    public function __construct() {
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
    }
    
    /**
     * @return TcpdfInterface
     */
    public function generateMainPage()
    {
        $page = new MainPage(
            $this->cv
        );
        
        return $page->createPage();
    }
    
    /**
     * @return TcpdfInterface
     */
    public function generateSecondPage()
    {
        $page = new SecondPage(
            $this->cv
        );
        
        return $page->createPage();
    }
}
