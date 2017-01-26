<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\AbstractSection;
use Application\Entity\SectionTitle;

class Expectations extends AbstractSection
{
    const CURSOR_X = 5;
    const CURSOR_Y = 263;
    
    const SECTION_WIDTH = 65;
    
    /**
     * {@inheritDoc}
     */
    public function addElements()
    {
        $this->tcpdf = $this->tcpdf->addElements();
        
        return $this->renderExpectations();
    }
    
    private function renderExpectations()
    {
        $x = self::CURSOR_X;
        $y = self::CURSOR_Y;
        
        $this->renderTitle(
            $this->createSectionTitle()
        );
        
        $text = 'Full time contract as Senior PHP Backend / Full Stack Developer position with salary 55.000 Euro gross / yearly. Elastic and flexible working hours, 40h weekly.';
        
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
        $sectionTitle->setTitle('Expectations');
        $sectionTitle->setWidth(self::SECTION_WIDTH);
        
        return $sectionTitle;
    }
}
