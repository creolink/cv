<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\AbstractSection;
use Application\Entity\SectionTitle;

class Education extends AbstractSection
{
    const CURSOR_X = 72.5;
    const CURSOR_Y = 251;
    
    const SECTION_WIDTH = 65;
    
    /**
     * {@inheritDoc}
     */
    public function addElements()
    {
        $this->tcpdf = $this->tcpdf->addElements();
        
        return $this->renderEducation();
    }
    
    private function renderEducation()
    {
        $x = self::CURSOR_X;
        $y = self::CURSOR_Y;
        
        $this->renderTitle(
            $this->createSectionTitle()
        );

        $text = "2013 - 2015 intensive English & German course," . "\r\n"
            ."2012 professional Google Analytics training," . "\r\n"
            ."since 2012 driving license category B," . "\r\n"
            ."further past: studies at the Lodz University of Technology (computer science, 3 years)";
        
        $this->tcpdf->SetXY($this->tcpdf->cursorPositionX, $this->tcpdf->cursorPositionY + 1);
        $this->tcpdf->SetFont($this->tcpdf->tahoma, '', 7);
        $this->tcpdf->MultiCell(63, 4, $text . "\r\n", 0, 'L', false);
        
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
        $sectionTitle->setTitle('Education & courses');
        $sectionTitle->setWidth(self::SECTION_WIDTH);
        
        return $sectionTitle;
    }
}
