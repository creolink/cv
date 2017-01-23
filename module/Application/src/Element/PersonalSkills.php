<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\AbstractSkills;

class PersonalSkills extends AbstractSkills
{
    /**
     * {@inheritDoc}
     */
    public function addElements()
    {
        $this->tcpdf = $this->tcpdf->addElements();
        
        $this->setSolidLine();
        
        return $this->renderPersonalSkills();
    }
    
    private function renderPersonalSkills()
    {
        $x = 140;
        $y = 77;

        $this->renderBlockTitle('Personality', $x, $y, 65);
        
        $x = $this->tcpdf->cursorPositionX + 2;
        $y = $this->tcpdf->cursorPositionY;
        $step = 4;
        $textWidth = 38;
        
        $this->renderSkillOnLeft($x, $y, 'Organization', 5, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Reliability', 5, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Teamwork', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Punctuality', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Management', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Assertiveness', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Independence', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Diligence', 4, $textWidth);
        //$this->renderSkillOnLeft($x, $y += $step, 'Work under time pressure', 3, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Creativity', 3, $textWidth);
        
        return $this->tcpdf;
    }
}
