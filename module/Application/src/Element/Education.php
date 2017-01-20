<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\AbstractSkills;

class Education extends AbstractSkills
{
    /**
     * {@inheritDoc}
     */
    public function addElements()
    {
        parent::addElements();
        
        return $this->renderTechnicalSkills();
    }
    
    private function renderTechnicalSkills()
    {
        $x = 5;
        $y = 249;
        
        $this->renderBlockTitle('Education & courses', $x, $y, 65);

        $text = '2013 - 2015 intensive English & German course, 2012 professional Google Analytics training, since 2012 driving license category B, further past: studies at the Lodz University of Technology (computer science, 3 years)';
        
        $this->tcpdf->SetXY($this->tcpdf->cursorPositionX, $this->tcpdf->cursorPositionY + 1);
        $this->tcpdf->SetFont($this->tcpdf->tahoma, '', 7);
        $this->tcpdf->MultiCell(63, 4, $text . "\r\n", 0, 'L', false);
        
        return $this->tcpdf;
    }
}
