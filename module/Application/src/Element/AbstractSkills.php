<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\AbstractBlockTitle;

abstract class AbstractSkills extends AbstractBlockTitle
{
    protected function renderSkillOnRight($x, $y, $text = '', $value = 5, $textWidth = 33)
    {
        $this->tcpdf->SetFont($this->tcpdf->verdana, '', 8);
        
        $this->tcpdf->SetXY($x, $y);
        $this->tcpdf->Cell($textWidth, 6, $text, 0, 0, 'L', false);

        $this->renderFilledCircle($x + $textWidth, $y + 3, $value);
    }
    
    protected function renderSkillOnLeft($x, $y, $text = '', $value = 5, $textWidth = 53)
    {
        $this->tcpdf->SetFont($this->tcpdf->verdana, '', 8);
        
        $this->tcpdf->SetXY($x + 15.8, $y);
        $this->tcpdf->Cell($textWidth, 6, $text, 0, 0, 'L', false);
        
        $this->renderFilledCircle($x, $y + 3.2, $value);
    }
    
    private function renderFilledCircle($x, $y, $value)
    {
        for ($counter = 0; $counter < 5; $counter++) {
            $this->renderCircle($x + (3.5 * $counter), $y);
            if ($value > $counter) {
                $this->renderCircle($x + (3.5 * $counter), $y, true);
            }
        }
    }
    
    private function renderCircle($x, $y, $filled = false)
    {
        $radius = 1.3;
        $style = '';
        $lineStyle = array(
            'width' => 0.1,
            'dash' => '0',
            'color' => array(
                150, 150, 150
            )
        );
        $fillColor = array();
        
        if (true === $filled) {
            $radius = 0.9;
            $fillColor = array(100, 100, 100);
            $style = 'F';
        }
        
        $this->tcpdf->circle($x, $y, $radius, 0, 360, $style, $lineStyle, $fillColor);
    }
}
