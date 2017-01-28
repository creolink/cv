<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Entity;

class Skill
{
    /**
     * Name of skill
     * 
     * @var string
     */
    private $name = '';
    
    /**
     * Starting cursor X position
     * 
     * @var float
     */
    private $cursorX = 0;
    
    /**
     * Starting cursor Y position
     * 
     * @var type
     */
    private $cursorY = 0;
    
    /**
     * Value of skill
     * 
     * @var int
     */
    private $value = 1;
    
    /**
     * Best strength of skill
     *
     * @var type 
     */
    private $strength = 4;
    
    /**
     * Time of experience in years
     * 
     * @var float
     */
    private $experienceYears = 0;
    
    /**
     * @param string $name
     */
    public function setName($name = '')
    {
        $this->name = $name;
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @param float $cursorX
     */
    public function setCursorX($cursorX)
    {
        $this->cursorX = $cursorX;
    }
    
    /**
     * @return float
     */
    public function getCursorX()
    {
        return $this->cursorX;
    }
    
    /**
     * @param float $cursorY
     */
    public function setCursorY($cursorY)
    {
        $this->cursorY = $cursorY;
    }
    
    /**
     * @return float
     */
    public function getCursorY()
    {
        return $this->cursorY;
    }
    
    /**
     * @param int $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
    
    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }
    
    /**
     * @param int $strength
     */
    public function setStrength($strength = 4)
    {
        $this->strength = $strength;
    }
    
    /**
     * @return int
     */
    public function getStrength()
    {
        return $this->strength;
    }
    
    /**
     * @param float $experienceYears
     */
    public function setExperienceYears($experienceYears = 0)
    {
        $this->experienceYears = $experienceYears;
    }
    
    /**
     * @return float
     */
    public function getExperienceYears()
    {
        return $this->experienceYears;
    }
}
