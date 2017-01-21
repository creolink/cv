<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\AbstractSkills;

class Languages extends AbstractSkills
{
    /**
     * {@inheritDoc}
     */
    public function addElements()
    {
        parent::addElements();
        
        return $this->renderLanguages();
    }
    
    private function renderLanguages()
    {
        $x = 140;
        $y = 122.5;
        
        $this->renderBlockTitle('Languages', $x, $y, 65);
        
        $x = $this->tcpdf->cursorPositionX + 2;
        $y = $this->tcpdf->cursorPositionY;
        
        $step = 3.5;
        $textWidth = 38;
        
        $this->renderSkillOnLeft($x, $y, 'Polish, mother language', 5);
        $this->renderSkillOnLeft($x, $y += $step, 'English (C1), prof. proficiency', 4);
        $this->renderSkillOnLeft($x, $y += $step, 'German (B1), communicative', 2);
        
        return $this->tcpdf;
    }
}
