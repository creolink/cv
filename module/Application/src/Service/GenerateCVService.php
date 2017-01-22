<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Service;

use Application\Model\CurriculumVitae;
use Application\Model\DocumentPage;
use Application\Model\MainPage;
use Application\Model\SecondPage;

class GenerateCVService
{
    /**
     * @var CurriculumVitae 
     */
    private $tcpdf;
    
    /**
     * @param CurriculumVitae $tcpdf
     */
    public function __construct(CurriculumVitae $tcpdf)
    {
        $this->tcpdf = $tcpdf;
    }
    
    public function renderCV()
    {
        $this->tcpdf = $this->generateMainPage();
        $this->tcpdf = $this->generateSecondPage();

        $this->tcpdf->renderPdf();
        
//        
//        /*
//        $this->_references('gandalf_references_en_1'); // references
//        $this->_references('gandalf_references_en_2'); // references
//        $this->_references('tpnets_en_1'); // references
//        $this->_references('tpnets_en_2'); // references
//        $this->_references('freepers_en'); // references
//        $this->_references('forweb_en_1'); // references
//        $this->_references('forweb_en_2'); // references
//        $this->_references('forweb_en_3'); // references
//        $this->_references('stawoz_en_1'); // references
//        $this->_references('stawoz_en_2'); // references
//        $this->_references('iizt'); // references
//        //*/
    }
    
    private function generateMainPage()
    {
        $page = new MainPage(
            $this->getNewPage()
        );
        
        return $page->createPage();
    }
    
    /**
     * @return type
     */
    private function generateSecondPage()
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
        return new DocumentPage($this->tcpdf);
    }
}
