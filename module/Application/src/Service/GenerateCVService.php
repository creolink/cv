<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Service;

use Application\Model\CurriculumVitae;
use Application\Helper\DateHelper;
use Application\Element\DocumentPage;
use Application\Element\MainHeader;
use Application\Element\TechnicalSkills;
use Application\Element\KnownTools;
use Application\Element\PersonalSkills;
use Application\Element\CareerGoals;
use Application\Element\Languages;
use Application\Element\EmploymentHistory;
use Application\Element\Education;
use Application\Element\AboutMe;
use Application\Element\Hobby;
use Application\Element\CommisionedJobs;
use Application\Element\QRCode;
use Application\Element\Sign;
use Application\Element\Expectations;

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
        $page = new CareerGoals($page);
        $page = new TechnicalSkills($page);
        $page = new KnownTools($page);
        $page = new PersonalSkills($page);
        $page = new Languages($page);
        $page = new EmploymentHistory($page);
        $page = new Education($page);
        $page = new Hobby($page);
        $page = new Expectations($page);
        $page = new AboutMe($page);
        $this->tcpdf = $page->createPage();
        
        $page = new DocumentPage($this->tcpdf);
        $page = new CommisionedJobs($page);
        $page = new QRCode($page);
        $page = new Sign($page);
        $this->tcpdf = $page->createPage();
        
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
