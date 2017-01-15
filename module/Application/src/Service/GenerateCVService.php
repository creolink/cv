<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Service;

use Application\Model\CurriculumVitae;
use Application\Helper\DateHelper;
use Application\Model\DocumentPage;
use Application\Element\MainHeader;

class GenerateCVService
{
    /**
     * @var TCPDF 
     */
    private $tcpdf;
    
    /**
     * @param CurriculumVitae $tcpdf
     * @param DateHelper $dateHelper
     */
    public function __construct(CurriculumVitae $tcpdf)
    {
        $this->tcpdf = $tcpdf;
    }
    
    public function renderCV()
    {
        $page = new DocumentPage($this->tcpdf);
        $page = new MainHeader($page);
        $this->tcpdf = $page->addElements();
        
        $this->tcpdf->renderPdf();
        
//        
//        $this->addNewPage();
//
//        $this->renderMainHeader();
//        $this->technicalSkills();
//        $this->renderPersonalSkills();
//        $this->knownTools();
//        $this->careerGoals();
//        $this->renderLanguages();
//        $this->renderEmploymentHistory();
//        $this->renderEducation();
//        $this->renderHobby();
//        $this->renderAboutMe();
//        
//        $this->addNewPage();
//        $this->renderCommisionedJobs();
//        $this->renderQRCode();
//        $this->renderSign();
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
//        
//        $this->Output();
    }
    
    /**
     * @return DateHelper
     */
    private function createDateHelper()
    {
        return new DateHelper(time());
    }
}