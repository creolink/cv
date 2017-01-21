<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Decorator\AbstractTcpdfDecorator;

abstract class AbstractBlockTitle extends AbstractTcpdfDecorator
{
    protected function renderBlockTitle($title, $x = 5, $y = 50, $width = 65, $hasLine = false, $height = 65)
    {
        $this->tcpdf->SetDrawColor(150, 150, 150);
        $this->tcpdf->SetFillColor(245,246,244);
        $this->tcpdf->SetTextColor(90, 90, 90);

        $this->tcpdf->SetFont($this->tcpdf->dejavu, 'B', 13);
        $this->tcpdf->SetXY($x + 0.6, $y);
        $this->tcpdf->Cell(100, 6, $title, 0, 0, 'L', false);
        
        $this->tcpdf->SetLineStyle(
                array('width' => 0.2, 'dash' => '0')
            );
        $this->tcpdf->Line($x, $y + 6, $x + $width, $y + 6);
        
        if (true === $hasLine) {
            $this->tcpdf->SetLineStyle(
                    array('width' => 0.2, 'dash' => '3,3')
                );
            $this->tcpdf->Line($x + 2, $y + 8, $x + 2, $y + $height);
        }
        
        $this->tcpdf->cursorPositionX = $x + 1;
        $this->tcpdf->cursorPositionY = $this->tcpdf->GetY() + 6;
    }
}
