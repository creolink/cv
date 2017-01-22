<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\AbstractBlockTitle;

class Expectations extends AbstractBlockTitle
{
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
        $x = 5;
        $y = 263;
        
        $this->renderBlockTitle('Expectations', $x, $y, 65);
        
        $text = 'Full time contract as Senior PHP Backend / Full Stack Developer position with salary 55.000 Euro gross / yearly. Elastic and flexible working hours, 40h weekly.';
        
        $this->tcpdf->SetXY($this->tcpdf->cursorPositionX, $this->tcpdf->cursorPositionY + 1);
        $this->tcpdf->SetFont($this->tcpdf->tahoma, '', 7);
        $this->tcpdf->MultiCell(63, 4, $text . "\r\n", 0, 'L', false);
        
        return $this->tcpdf;
    }
}
