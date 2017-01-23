<?php

/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\AbstractBlockTitle;
use Application\Helper\DateHelper;
use Application\Config\PersonalData;

class CareerGoals extends AbstractBlockTitle
{
    /**
     * {@inheritDoc}
     */
    public function addElements()
    {
        $this->tcpdf = $this->tcpdf->addElements();
        
        $this->setSolidLine();
        
        return $this->renderCareerGoals();
    }
    
    private function renderCareerGoals()
    {
        $x = 5;
        $y = 47;
        
        $dateHelper = new DateHelper(
            strtotime(PersonalData::BIRTH_DATE)
        );
        
        $workedYears = $dateHelper->getPassedYears(
            PersonalData::WORK_START_YEAR
        );
        
        $this->renderBlockTitle('Career goals', $x, $y, 200, 27.5);
        
        $this->tcpdf->SetFont($this->tcpdf->verdanaItalic, 'I', 9);
        $this->tcpdf->SetXY($x + 1, $y + 7);
        $this->tcpdf->Cell(100, 6, 'Dear Sir or Madam / Mr Smith / Ms Smith / Mrs Smith', 0, 0, 'L', false);
        
        $this->tcpdf->SetFont($this->tcpdf->verdanaItalic, 'I', 7.5);
        $this->tcpdf->SetXY($x + 1, $y + 12);
        $this->tcpdf->MultiCell(198, 4, "I am a full stack developer. My passion is system designing and coding in PHP language. I have many years of experience as programmer in project design & development (" . $workedYears . " years) as well as team coordinator and project manager (6 years). I feel the best as developer and coder of big B2E, B2B, B2C eCommerce web projects. I like all kind of tasks, easy and challenging one. I gladly accept challenges basing on new technical solutions. I'm very well organized, thorough and flexible in teamwork. I am also appreciated for independent and remote work. My future goal is to become a manager of big IT department of international company.\r\n", 0, 'J', false);
        
        return $this->tcpdf;
    }
}
