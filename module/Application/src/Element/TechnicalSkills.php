<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Decorator\AbstractPdfDocumentDecorator;

class TechnicalSkills extends AbstractPdfDocumentDecorator
{
    /**
     * {@inheritDoc}
     */
    public function addElements()
    {
        parent::addElements();
        
        return $this->technicalSkills();
    }
    
    private function technicalSkills()
    {
        $x = 5;
        $y = 77;
        
        $this->renderBlockTitle('Technical skills', $x, $y, 65, 67.5);

        $x = $this->tcpdf->cursorPositionX + 2;
        $y = $this->tcpdf->cursorPositionY;
        $step = 3.5;
        $textWidth = 38;
        
        $this->renderSkillOnLeft($x, $y, 'PHP 4/5/6/7, OOP & PSR', 5, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'MySQL & MariaDB / Percona', 5, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'TDD, UnitTesting', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Symfony 2 & 3', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'SOLID, Clear code, KISS, DRY', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Soap, Rest, Json, Xml, OAuth', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'SEO, SEM', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'UML, WEB / UI / DB Design', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Patterns: Factory, DI, MVC, ...', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'X/HTML5, Css, Sass, Less', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'JS, jQuery, React, Typescript', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Nginx config, Lighttpd, Apache', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Elastic Search, Solr, Sphinx', 3, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'MsSQL, PostgreSQL', 2, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'ZF 1/2, Smarty', 2, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Perl, Python, C#, Java, C++', 1, $textWidth);
        
        return $this->tcpdf;
    }
    
    private function renderBlockTitle($title, $x = 5, $y = 50, $width = 65, $hasLine = false, $height = 65)
    {
        $this->tcpdf->SetDrawColor(150, 150, 150);
        $this->tcpdf->SetFillColor(245,246,244);
        $this->tcpdf->SetTextColor(90, 90, 90);

        $this->tcpdf->SetFont($this->tcpdf->dejavu, 'B', 13);
        $this->tcpdf->SetXY($x + 0.6, $y);
        $this->tcpdf->Cell(100, 6, $title, 0, 0, 'L', false);
        
        $this->tcpdf->SetLineStyle(
                array('width' => 0.2, 'dash' => '0')
            );
        $this->tcpdf->Line($x, $y + 6, $x + $width, $y + 6);
        
        if (true === $hasLine) {
            $this->tcpdf->SetLineStyle(
                    array('width' => 0.2, 'dash' => '3,3')
                );
            $this->tcpdf->Line($x + 2, $y + 8, $x + 2, $y + $height);
        }
        
        $this->tcpdf->cursorPositionX = $x + 1;
        $this->tcpdf->cursorPositionY = $this->tcpdf->GetY() + 6;
    }
    
    private function renderSkillOnRight($x, $y, $text = '', $value = 5, $textWidth = 33)
    {
        $this->tcpdf->SetFont($this->tcpdf->verdana, '', 7);
        
        $this->tcpdf->SetXY($x, $y);
        $this->tcpdf->Cell(53, 6, $text, 0, 0, 'L', false);
        
        $lineStyle = array(
            'width' => 0.1,
            'dash' => '0'
        );
        
        $fillColor = array(100, 100, 100);
        
        $y = $y + 3;
        $x = $x + $textWidth;
        
        for ($counter = 0; $counter < 6; $counter++) {
            $this->renderCircle($x + (3.5 * $counter), $y);
            if ($value > $counter) {
                $this->renderCircle($x + (3.5 * $counter), $y, true);
            }
        }
    }
    
    private function renderSkillOnLeft($x, $y, $text = '', $value = 5, $textWidth = 53)
    {
        $this->tcpdf->SetFont($this->tcpdf->verdana, '', 8);
        
        $this->tcpdf->SetXY($x + 15.8, $y);
        $this->tcpdf->Cell($textWidth, 6, $text, 0, 0, 'L', false);
        
        $lineStyle = array(
            'width' => 0.1,
            'dash' => '0'
        );
        
        $fillColor = array(100, 100, 100);
        
        $y = $y + 3.2;
        
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
