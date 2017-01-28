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
use Application\Exception\EntityNotFoundException;
use Zend\Hydrator\ClassMethods as Hydrator;

abstract class AbstractSkills extends AbstractSection
{
    const NEXT_LINE_POSITION = 3.5;
    
    /**
     * Renders position with circles on left
     * 
     * @param Position|Skill $position
     * @param float $x
     * @param float $y
     */
    protected function renderPosition(Position $position, $x = 0, $y = 0)
    {
        $this->renderCircles($x, $y + 3.2, $position->getStrength());
        
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
     * @obsolete Use renderPosition instead
     * @param type $x
     * @param type $y
     * @param type $text
     * @param type $value
     * @param type $textWidth
     */
    protected function renderSkillOnLeftOld($x, $y, $text = '', $value = 5, $textWidth = 38)
    {
        $this->renderCircles($x, $y + 3.2, $value);
        
        $this->tcpdf->SetXY($this->tcpdf->GetX() + 1.3, $y);
        $this->tcpdf->SetFont($this->tcpdf->verdana, '', 8);
        
        $textWidth = $this->tcpdf->GetStringWidth($text);
        $this->tcpdf->Cell($textWidth , 6, $text, 0, 0, 'L');
        
        $this->tcpdf->SetXY($this->tcpdf->GetX() + 1, $y);
        $this->tcpdf->SetFont($this->tcpdf->verdanaItalic, '', 5);
        $this->tcpdf->Cell(0, 6, '(' . mt_rand(5,15) . 'y)', 0, 0, 'L', false);
    }
    
    /**
     * Renders list of skills
     * 
     * @param Position[] $positions
     */
    protected function renderPositions($positions)
    {
        $x = $this->tcpdf->GetX() + 2.3;
        $y = $this->tcpdf->GetY() - 1;

        $counter = 0;

        foreach ($positions as $position) {
            if ($position->isDisabled()) {
                continue;
            }
            
            $this->renderPosition(
                $position,
                $x,
                $y + (self::NEXT_LINE_POSITION * ($counter++))
            );
        }
    }
    
    /**
     * Returns array of skill objects
     * 
     * @param array $config
     * @param string $class
     * @throws EntityNotFoundException
     * @return Position[]
     */
    protected function getPositions(array $config = [], $class = '')
    {
        $positions = [];
      
        $this->validateClass($class);
        
        foreach ($config['skills'] as $skill) {
            $positions[] = $this->getHydrator()->hydrate($skill, new $class);
        }
        
        return $positions;
    }
    
    /**
     * @return Hydrator
     */
    private function getHydrator()
    {
        return new Hydrator();
    }
    
    /**
     * Validates class name
     * 
     * @param string $class
     * @throws EntityNotFoundException
     */
    private function validateClass($class)
    {
        if (false === class_exists($class)) {
            throw new EntityNotFoundException(
                sprintf(
                    "Entity %s not found.",
                    $class
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
    private function renderCircles($x, $y, $value)
    {
        for ($counter = 0; $counter < 4; $counter++) {
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
