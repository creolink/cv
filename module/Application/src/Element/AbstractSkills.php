<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\AbstractSection;
use Application\Entity\Position;
use Application\Entity\Skill;

abstract class AbstractSkills extends AbstractSection
{
    const POSITION_MARGIN = 3.5;
    const FIRST_LINE_MARGIN = -1;
    const POSITION_PADDING = 2.3;
    
    /**
     * Renders list of skills
     * 
     * @param Position[] $positions
     */
    protected function renderPositions($positions)
    {
        $x = $this->tcpdf->GetX() + self::POSITION_PADDING;
        $y = $this->tcpdf->GetY() + self::FIRST_LINE_MARGIN;

        $counter = 0;

        foreach ($positions as $position) {
            if ($position->isDisabled()) {
                continue;
            }
            
            $this->renderPosition(
                $position,
                $x,
                $y + (self::POSITION_MARGIN * ($counter++))
            );
        }
    }
    
    /**
     * Renders position with circles on left
     * 
     * @param Position|Skill $position
     * @param float $x
     * @param float $y
     */
    private function renderPosition(Position $position, $x = 0, $y = 0)
    {
        $this->renderCircles($x, $y + 3.2, $position->getLevel(), $position->getStrength());
        
        $this->tcpdf->SetXY($this->tcpdf->GetX() + 1.3, $y);
        $this->tcpdf->SetFont($this->tcpdf->verdana, '', 8);
        
        $textWidth = $this->tcpdf->GetStringWidth($position->getName());
        $this->tcpdf->Cell($textWidth , 6, $position->getName());
        
        if ($position instanceof Skill) {
            $this->tcpdf->SetXY($this->tcpdf->GetX() + 1, $y);
            $this->tcpdf->SetFont($this->tcpdf->verdanaItalic, '', 5);
            $this->tcpdf->Cell(
                0,
                6,
                $this->createExperienceText(
                    $position->getExperience()
                )
            );
        }
    }
    
    /**
     * Renders filled circle
     * 
     * @param float $x
     * @param float $y
     * @param int $value
     */
    private function renderCircles($x, $y, $value, $strength = 4)
    {
        for ($counter = 0; $counter < $strength; $counter++) {
            $this->renderCircle($x + (3.5 * $counter), $y);
            
            if ($value > $counter) {
                $this->renderCircle($x + (3.5 * $counter), $y, true);
            }
        }
    }
    
    /**
     * Renders circle / filled circle
     * 
     * @param float $x
     * @param float $y
     * @param bool $filled
     */
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
        
        $this->tcpdf->SetXY($x, $y);
    }
    
    /**
     * Creates experience text with proper number of years or month
     * 
     * @param float $years
     * @return string
     */
    private function createExperienceText($years = 1)
    {
        $text = '('
            . ($years < 1 ? ceil(12 * $years) . 'm' : $years . 'y')
            . ')';
        
        return $text;
    }
}
