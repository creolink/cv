<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\AbstractSkills;
use Application\Entity\SectionTitle;

class SoftwareAndTools extends AbstractSkills
{
    const CURSOR_X = 72.5;
    const CURSOR_Y = 77;
    
    const SECTION_WIDTH = 65;
    
    /**
     * {@inheritDoc}
     */
    public function addElements()
    {
        $this->tcpdf = $this->tcpdf->addElements();
        
        $this->setSolidLine();
        
        return $this->renderKnownTools();
    }
    
    private function renderKnownTools()
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
        
        $this->renderSkillOnLeftOld($x, $y, 'Netbeans, PHPStorm', 4, $textWidth); //10y
        $this->renderSkillOnLeftOld($x, $y += $step, 'Debian, Ubuntu, Fedora', 4, $textWidth); //10y
        $this->renderSkillOnLeftOld($x, $y += $step, 'MySQL Workbench, PMA', 4, $textWidth); //10y
        $this->renderSkillOnLeftOld($x, $y += $step, 'Nginx, Lighttpd, Apache', 4, $textWidth); //7y
        $this->renderSkillOnLeftOld($x, $y += $step, 'Google Analytics, Adwords', 4, $textWidth); //7y
        $this->renderSkillOnLeftOld($x, $y += $step, 'Soap, Rest, OAuth', 4, $textWidth); //7y
        $this->renderSkillOnLeftOld($x, $y += $step, 'Git, Svn', 4, $textWidth); //6y
        $this->renderSkillOnLeftOld($x, $y += $step, 'PHP FPM, APC, Memcache', 4, $textWidth); //5y
        $this->renderSkillOnLeftOld($x, $y += $step, 'FPDF, TCPDF', 4, $textWidth); //5y
        $this->renderSkillOnLeftOld($x, $y += $step, 'DIA, Confluence', 4, $textWidth); //5y
        $this->renderSkillOnLeftOld($x, $y += $step, 'CodeSniffer, PhpDoc', 3, $textWidth); //4y
        $this->renderSkillOnLeftOld($x, $y += $step, 'VirtualBox, Docker, Vagrant', 3, $textWidth); //3y
        $this->renderSkillOnLeftOld($x, $y += $step, 'Trac, JIRA, Jenkins', 3, $textWidth); //3y
        $this->renderSkillOnLeftOld($x, $y += $step, 'Composer, Node.js, npm', 3, $textWidth); //3y
        $this->renderSkillOnLeftOld($x, $y += $step, 'GIMP, Photoshop', 2, $textWidth); //3y
        $this->renderSkillOnLeftOld($x, $y += $step, 'Percona server, Galera Cluster', 1, $textWidth); //2y
        
        
        
        // Commented for future needs
        //$this->renderSkillOnLeft($x, $y += $step, 'Apache jMeter', 4, $textWidth); //1y
        //$this->renderSkillOnLeft($x, $y += $step, 'xenu, Total validator', 3, $textWidth); //1y
        //$this->renderSkillOnLeft($x, $y += $step, 'adminer', 3, $textWidth); //5y
        //$this->renderSkillOnLeft($x, $y += $step, 'manual UI tests, acceptance tests', 3, $textWidth); //8y
        //$this->renderSkillOnLeft($x, $y += $step, 'Audio Watermarking Tools 2', 3, $textWidth); //1y
        //$this->renderSkillOnLeft($x, $y += $step, 'Macromedia Dreamweaver & Fireworks', 3, $textWidth); //4y
        //$this->renderSkillOnLeft($x, $y += $step, 'Firefox, Opera, Chrome, IE', 3, $textWidth); //16y
        //$this->renderSkillOnLeft($x, $y += $step, 'SeveralNines Cluster Control', 3, $textWidth); //1y
        //$this->renderSkillOnLeft($x, $y += $step, 'MS Office, LibreOffice, OpenOffice', 3, $textWidth); //10y
        //$this->renderSkillOnLeft($x, $y += $step, 'Eset', 3, $textWidth); //4y
        //$this->renderSkillOnLeft($x, $y += $step, 'Total Commander, mc', 3, $textWidth); //15y
        //$this->renderSkillOnLeft($x, $y += $step, 'Acunetix web vulnerability scanner', 3, $textWidth); //2y
        //$this->renderSkillOnLeft($x, $y += $step, 'Axure RP Pro', 3, $textWidth); //1y
        //$this->renderSkillOnLeft($x, $y += $step, 'Bootstrap', 3, $textWidth); //1y
        //$this->renderSkillOnLeft($x, $y += $step, 'Grunt', 3, $textWidth); //1y
        //$this->renderSkillOnLeft($x, $y += $step, 'Enova, Optima, WFMag, Subiekt', 5, $textWidth); //3y
        //$this->renderSkillOnLeft($x, $y += $step, 'Mrtg, Cacti, Mtr, Traceroute', 4, $textWidth); //7y
        //$this->renderSkillOnLeft($x, $y += $step, 'VMware ESX Server & Center', 2, $textWidth); //2y
        //$this->renderSkillOnLeft($x, $y += $step, 'HTML Validator, W3C', 4, $textWidth); //6y
        
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
        $sectionTitle->setTitle('Software, tools & skills');
        $sectionTitle->setWidth(self::SECTION_WIDTH);
        
        return $sectionTitle;
    }
}
