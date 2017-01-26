<?php

/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\AbstractSection;
use Application\Helper\DateHelper;
use Application\Config\PersonalData;
use Application\Entity\SectionTitle;

class CareerGoals extends AbstractSection
{
    const CURSOR_X = 5;
    const CURSOR_Y = 47;
    
    const SECTION_WIDTH = 200;
    
    const HEADER_CELL_HEIGHT = 6;
    const TEXT_CELL_HEIGHT = 4;
    
    const FONT_SIZE = 7.5;
    
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
        $x = self::CURSOR_X;
        $y = self::CURSOR_Y;
        
        $dateHelper = new DateHelper(
            strtotime(PersonalData::BIRTH_DATE)
        );
        
        $workedYears = $dateHelper->getPassedYears(
            PersonalData::WORK_START_YEAR
        );
        
        $this->renderTitle(
            $this->createSectionTitle()
        );
        
        $this->tcpdf->SetFont($this->tcpdf->verdanaItalic, 'I', 9);
        $this->tcpdf->SetXY($x + 1, $y + 7);
        $this->tcpdf->Cell(100, self::HEADER_CELL_HEIGHT, 'Dear Sir or Madam / Mr Smith / Ms Smith / Mrs Smith', 0, 0, 'L', false);
        
        $this->tcpdf->SetFont($this->tcpdf->verdanaItalic, 'I', self::FONT_SIZE);
        $this->tcpdf->SetXY($x + 1, $y + 12);
        $this->tcpdf->MultiCell(198, self::TEXT_CELL_HEIGHT, "I am a full stack developer. My passion is system designing and coding in PHP language. I have many years of experience as programmer in project design & development (" . $workedYears . " years) as well as team coordinator and project manager (6 years). I feel the best as developer and coder of big B2E, B2B, B2C eCommerce web projects. I like all kind of tasks, easy and challenging one. I gladly accept challenges basing on new technical solutions. I'm very well organized, thorough and flexible in teamwork. I am also appreciated for independent and remote work. My future goal is to become a manager of big IT department of international company.\r\n", 0, 'J', false);
        
        return $this->tcpdf;
    }
    
    /**
     * @return SectionTitle
     */
    private function createSectionTitle()
    {
        $sectionTitle = new SectionTitle();
        $sectionTitle->setCursorX(self::CURSOR_X);
        $sectionTitle->setCursorY(self::CURSOR_Y);
        $sectionTitle->setTitle('Career goals');
        $sectionTitle->setWidth(self::SECTION_WIDTH);
        
        return $sectionTitle;
    }
}
