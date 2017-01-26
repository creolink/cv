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
        
        $this->renderSkillOnLeft($x, $y, 'PHP 4/5/6/7, OOP & PSR', 5, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'MySQL (Percona / MariaDB)', 5, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'SOLID, Clear code, KISS, DRY', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Patterns: Factory, DI, MVC, ...', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'TDD, PHPUnit', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Symfony 2 & 3', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Soap, Rest, Json, Xml, OAuth', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'SEO, SEM', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'UML, WEB / UI / DB Design', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'X/HTML5, Css, Sass, Less', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'JS, jQuery, React, Typescript', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Nginx config, Lighttpd, Apache', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'ZF 1/2, Smarty', 3, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Elastic Search, Solr, Sphinx', 3, $textWidth);
        //$this->renderSkillOnLeft($x, $y += $step, 'MsSQL, PostgreSQL', 2, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'BDD, Behat', 2, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Perl, Python, Java', 1, $textWidth);
        
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
        $sectionTitle->setTitle('Technical skills');
        $sectionTitle->setWidth(self::SECTION_WIDTH);
        
        return $sectionTitle;
    }
}
