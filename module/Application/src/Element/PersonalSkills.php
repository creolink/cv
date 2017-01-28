<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\AbstractSkills;
use Application\Entity\SectionTitle;

class PersonalSkills extends AbstractSkills
{
    const CURSOR_X = 140;
    const CURSOR_Y = 77;
    
    const SECTION_WIDTH = 65;
    
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
        $x = self::CURSOR_X;
        $y = self::CURSOR_Y;

        $this->renderTitle(
            $this->createSectionTitle()
        );
        
        $x = $this->tcpdf->cursorPositionX + 2;
        $y = $this->tcpdf->cursorPositionY;
        $step = 4;
        $textWidth = 38;
        
        $this->renderSkillOnLeft($x, $y, 'Organization', 5, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Reliability', 5, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Cooperation', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Punctuality', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Management', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Assertiveness', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Independence', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Diligence', 4, $textWidth);
        //$this->renderSkillOnLeft($x, $y += $step, 'Work under time pressure', 3, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Creativity', 3, $textWidth);
        
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
        $sectionTitle->setTitle('Personality');
        $sectionTitle->setWidth(self::SECTION_WIDTH);
        
        return $sectionTitle;
    }
}
