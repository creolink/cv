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
use Application\Config\Font;

class CareerGoals extends AbstractSection
{
    const CURSOR_X = 5;
    const CURSOR_Y = 47;
    
    const SECTION_WIDTH = 200;
    const SECTION_PADDING = 1;
    
    const RECIPIENT_CELL_HEIGHT = 6;
    const RECIPIENT_CELL_WIDTH = 198;
    const RECIPIENT_MARGIN = 7;
    const RECIPIENT_FONT_SIZE = 9;
    
    const CONTENT_CELL_HEIGHT = 4;
    const CONTENT_CELL_WIDTH = 198;
    const CONTENT_MARGIN = 12;
    const CONTENT_FONT_SIZE = 7.5;
    
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
        $this->renderTitle(
            $this->createSectionTitle()
        );
        
        $this->renderRecipient();
        $this->renderContent();
        
        return $this->tcpdf;
    }
    
    private function renderRecipient()
    {
        $this->tcpdf->SetFont(
            $this->tcpdf->verdanaItalic,
            Font::ITALICT,
            self::RECIPIENT_FONT_SIZE
        );
        
        $this->tcpdf->SetXY(
            self::CURSOR_X + self::SECTION_PADDING,
            self::CURSOR_Y + self::RECIPIENT_MARGIN
        );
        
        $this->tcpdf->Cell(
            self::RECIPIENT_CELL_WIDTH,
            self::RECIPIENT_CELL_HEIGHT,
            'Dear Sir or Madam / Mr Smith / Ms Smith / Mrs Smith'
        );
    }
    
    private function renderContent()
    {
        $dateHelper = new DateHelper(
            strtotime(PersonalData::BIRTH_DATE)
        );
        
        $workedYears = $dateHelper->getPassedYears(
            PersonalData::WORK_START_YEAR
        );
        
        $this->tcpdf->SetFont(
            $this->tcpdf->verdanaItalic,
            Font::ITALICT,
            self::CONTENT_FONT_SIZE
        );
        
        $this->tcpdf->SetXY(
            self::CURSOR_X + self::SECTION_PADDING,
            self::CURSOR_Y + self::CONTENT_MARGIN
        );
        
        $this->tcpdf->MultiCell(
            self::CONTENT_CELL_WIDTH,
            self::CONTENT_CELL_HEIGHT,
            "I am a full stack developer. My passion is system designing and coding in PHP language. I have many years of experience as programmer in project design & development (" . $workedYears . " years) as well as team coordinator and project manager (6 years). I feel the best as developer and coder of big B2E, B2B, B2C eCommerce web projects. I like all kind of tasks, easy and challenging one. I gladly accept challenges basing on new technical solutions. I'm very well organized, thorough and flexible in teamwork. I am also appreciated for independent and remote work. My future goal is to become a manager of big IT department of international company.\r\n"
        );
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
