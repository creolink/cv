<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\AbstractSkills;
use Application\Entity\SectionTitle;
use Application\Entity\Position;

class Languages extends AbstractSkills
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
        
        return $this->renderLanguages();
    }
    
    private function renderLanguages()
    {
        $this->renderTitle(
            $this->createSectionTitle()
        );

        $this->renderPositions(
            $this->getPositions(
                'languages.yml',
                Position::class
            )
        );
        
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
        $sectionTitle->setTitle('Languages');
        $sectionTitle->setWidth(self::SECTION_WIDTH);
        
        return $sectionTitle;
    }
}
