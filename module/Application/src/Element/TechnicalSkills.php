<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\AbstractSkills;
use Application\Entity\SectionTitle;

class TechnicalSkills extends AbstractSkills
{
    const CURSOR_X = 5;
    const CURSOR_Y = 77;
    
    const SECTION_WIDTH = 65;
    
    
    
    /**
     * {@inheritDoc}
     */
    public function addElements()
    {
        $this->tcpdf = $this->tcpdf->addElements();
        
        return $this->renderTechnicalSkills();
    }
    
    private function renderTechnicalSkills()
    {
        $x = self::CURSOR_X;
        $y = self::CURSOR_Y;
        
        $this->renderTitle(
            $this->createSectionTitle()
        );

        $x = $this->tcpdf->cursorPositionX + 2;
        $y = $this->tcpdf->cursorPositionY;
        $step = 3.5;
        $textWidth = 38;
        
        $this->renderSkillOnLeft($x, $y, 'PHP 4/5/6/7, OOP & PSR', 4, $textWidth); //15y
        $this->renderSkillOnLeft($x, $y += $step, 'MySQL: Percona / MariaDB', 4, $textWidth); //14y
        $this->renderSkillOnLeft($x, $y += $step, 'HTML 4/5, XHTML, Css', 4, $textWidth); //15y
        $this->renderSkillOnLeft($x, $y += $step, 'JS, jQuery, Json, Xml', 4, $textWidth); //10y
        $this->renderSkillOnLeft($x, $y += $step, 'SEO, SEM', 4, $textWidth); //10y
        $this->renderSkillOnLeft($x, $y += $step, 'UML, WEB / UI / DB Design', 4, $textWidth); //10y
        $this->renderSkillOnLeft($x, $y += $step, 'Linux, Windows', 4, $textWidth); //10y
        $this->renderSkillOnLeft($x, $y += $step, 'SOLID, Clean code, KISS, DRY', 3, $textWidth); //4y
        $this->renderSkillOnLeft($x, $y += $step, 'Symfony 2 & 3', 3, $textWidth); //4y
        $this->renderSkillOnLeft($x, $y += $step, 'Design patterns: MVC, DI, ...', 3, $textWidth); //4y
        $this->renderSkillOnLeft($x, $y += $step, 'TDD, PHPUnit', 3, $textWidth); //2y
        //$this->renderSkillOnLeft($x, $y += $step, 'Sass, Less', 2, $textWidth); //2y
        $this->renderSkillOnLeft($x, $y += $step, 'Elastic Search, Solr, Sphinx', 2, $textWidth); //2y
        $this->renderSkillOnLeft($x, $y += $step, 'React, Typescript', 2, $textWidth); //1y
        $this->renderSkillOnLeft($x, $y += $step, 'ZF 1 & 2', 1, $textWidth); //1y
        $this->renderSkillOnLeft($x, $y += $step, 'BDD, Behat', 1, $textWidth); //6m
        $this->renderSkillOnLeft($x, $y += $step, 'Perl, Python, Java', 1, $textWidth); //6m
        
        // Commented for future needs
        //$this->renderSkillOnLeft($x, $y += $step, 'MsSQL, PostgreSQL', 2, $textWidth); //1y
        
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
        $sectionTitle->setTitle('Technical experience');
        $sectionTitle->setWidth(self::SECTION_WIDTH);
        
        return $sectionTitle;
    }
}
