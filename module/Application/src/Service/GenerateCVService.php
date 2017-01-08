<?php

namespace Application\Service;

use Application\Model\CurriculumVitae;
use Application\Helper\DateHelper;

class GenerateCVService
{
    /**
     * @var TCPDF 
     */
    private $tcpdf;
    
    /**
     * @var DateHelper 
     */
    private $dateHelper;
    
    /**
     * @param CurriculumVitae $tcpdf
     * @param DateHelper $dateHelper
     */
    public function __construct(
        CurriculumVitae $tcpdf,
        DateHelper $dateHelper
    ) {
        $this->tcpdf = $tcpdf;
        $this->dateHelper = $dateHelper;
    }
    
    public function renderCV()
    {
        $this->tcpdf->configure();
        
        
        
        
        $this->tcpdf->render();
        
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
}