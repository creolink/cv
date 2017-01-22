<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Builder;

use Application\Model\CurriculumVitae;
use Application\Model\DocumentPage;
use Application\Model\MainPage;
use Application\Model\SecondPage;

class CurriculumVitaeBuilder extends AbstractBuilder
{
    /**
     * @var TCPDF
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
     * @return TcpdfInterface
     */
    public function generateMainPage()
    {
        $page = new MainPage(
            $this->getNewPage()
        );
        
        return $page->createPage();
    }
    
    /**
     * @return TcpdfInterface
     */
    public function generateSecondPage()
    {
        $page = new SecondPage(
            $this->getNewPage()
        );
        
        return $page->createPage();
    }
    
    /**
     * @return DocumentPage
     */
    private function getNewPage()
    {
        return new DocumentPage($this->cv);
    }
}
