<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\AbstractSkills;

class KnownTools extends AbstractSkills
{
    /**
     * {@inheritDoc}
     */
    public function addElements()
    {
        $this->tcpdf = $this->tcpdf->addElements();
        
        return $this->renderKnownTools();
    }
    
    private function renderKnownTools()
    {
        $x = 72.5;
        $y = 77;
        
        $this->renderBlockTitle('Known software & tools', $x, $y, 65);
        
        $x = $this->tcpdf->cursorPositionX + 2;
        $y = $this->tcpdf->cursorPositionY;
        $step = 3.5;
        $textWidth = 38;
        
        $this->renderSkillOnLeft($x, $y, 'Netbeans, PHPStorm', 6, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Debian, Ubuntu, Fedora', 5, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Git, Svn', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'JIRA, Trac, Jenkins', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Composer, Node.js, npm', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'PHP FPM, APC, Memcache', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'CodeSniffer, PhpDoc', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'MySQL Workbench, PMA', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'HTML Validator, W3C', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Mrtg, Cacti, Mtr, Traceroute', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'DIA, Software Ideas Modeler', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Google Analytics, Adwords', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'FPDF, TCPDF', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Percona server, Galera Cluster', 3, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'GIMP, Photoshop', 2, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'VirtualBox, Docker, Vagrant', 2, $textWidth);
        
        // Commented for future needs
        //$this->renderSkillOnLeft($x, $y += $step, 'Apache jMeter', 4, $textWidth);
        //$this->renderSkillOnLeft($x, $y += $step, 'xenu, Total validator', 3, $textWidth);
        //$this->renderSkillOnLeft($x, $y += $step, 'adminer', 3, $textWidth);
        //$this->renderSkillOnLeft($x, $y += $step, 'Adwords', 3, $textWidth);
        //$this->renderSkillOnLeft($x, $y += $step, 'manual UI tests, acceptance tests', 3, $textWidth);
        //$this->renderSkillOnLeft($x, $y += $step, 'Audio Watermarking Tools 2', 3, $textWidth);
        //$this->renderSkillOnLeft($x, $y += $step, 'Macromedia Fireworks, Macromedia Dreamweaver', 3, $textWidth);
        //$this->renderSkillOnLeft($x, $y += $step, 'Firefox, Opera, Chrome, IE', 3, $textWidth);
        //$this->renderSkillOnLeft($x, $y += $step, 'Cluster Control (Percona, SeveralNines)', 3, $textWidth);
        //$this->renderSkillOnLeft($x, $y += $step, 'MS Office, LibreOffice, OpenOffice', 3, $textWidth);
        //$this->renderSkillOnLeft($x, $y += $step, 'Eset', 3, $textWidth);
        //$this->renderSkillOnLeft($x, $y += $step, 'Total Commander, mc', 3, $textWidth);
        //$this->renderSkillOnLeft($x, $y += $step, 'Acunetix web vulnerability scanner', 3, $textWidth);
        //$this->renderSkillOnLeft($x, $y += $step, 'Axure RP Pro', 3, $textWidth);
        //$this->renderSkillOnLeft($x, $y += $step, 'Bootstrap', 3, $textWidth);
        //$this->renderSkillOnLeft($x, $y += $step, 'Grunt', 3, $textWidth);
        //$this->skillOnLeft($x, $y += $step, 'Enova, Optima, WFMag, Subiekt', 5, $textWidth);
        
        return $this->tcpdf;
    }
}
