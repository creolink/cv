<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\AbstractSection;
use Application\Entity\SectionTitle;
use Application\Config\Font;

class Education extends AbstractSection
{
    const CURSOR_X = 72.5;
    const CURSOR_Y = 251;
    
    const SECTION_WIDTH = 65;
    
    const CELL_HEIGHT = 4;
    const CELL_PADDING = 1;
    
    const FONT_SIZE = 7;
    
    /**
     * {@inheritDoc}
     */
    public function addElements()
    {
        $this->tcpdf = $this->tcpdf->addElements();
        
        $this->setSolidLine();
        
        return $this->renderEducation();
    }
    
    /**
     * @return TcpdfInterface
     */
    private function renderEducation()
    {
        $this->renderTitle(
            $this->createSectionTitle()
        );
        
        $this->renderContent();

        return $this->tcpdf;
    }
    
    /**
     * Renders content of element
     */
    private function renderContent()
    {
        $this->tcpdf->SetFont(
            $this->tcpdf->tahoma,
            Font::NORMAL,
            self::FONT_SIZE
        );
        
        $this->tcpdf->MultiCell(
            self::SECTION_WIDTH - self::CELL_PADDING,
            self::CELL_HEIGHT,
            $this->getContent(),
            self::BORDER_NONE,
            self::ALIGN_LEFT
        );
    }
    
    /**
     * @return string
     */
    private function getContent()
    {
        return "2013 - 2015 intensive English & German course," . self::NEW_LINE
            ."2012 professional course of Information Security Administrator with certificate" . self::NEW_LINE
            ."2012 professional Google Analytics training," . self::NEW_LINE
            ."since 2012 driving license category B," . self::NEW_LINE
            ."further past: studies at the Lodz University of Technology (computer science, 3 years)" . self::NEW_LINE;
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
