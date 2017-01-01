<?php

namespace Application\Model;

use Application\Model\CurriculumVitae;

class CreatePage
{
    /**
     * @var CurriculumVitae $tcpdf 
     */
    private $tcpdf;
    
    /**
     * @param CurriculumVitae $tcpdf
     */
    public function __construct(CurriculumVitae $tcpdf) {
        $this->tcpdf = $tcpdf;
    }
    
    /**
     * @return CurriculumVitae
     */
    public function createPage()
    {
        $this->tcpdf->SetMargins(1, 1, 1);
        
        $this->tcpdf->AddPage();
        
        $this->tcpdf->SetTextColor(0, 0, 0);
        $this->tcpdf->SetFont($this->dejavu, '', 8);
        $this->tcpdf->SetXY(0, 0);
        
        return $this->tcpdf;
    }
}