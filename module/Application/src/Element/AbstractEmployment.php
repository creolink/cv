<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\AbstractBlockTitle;
use Application\Config\PdfConfig;

abstract class AbstractEmployment extends AbstractBlockTitle
{
    protected function renderEmploymentPosition(
        $x,
        $y,
        $date = '',
        $positionName = '',
        $company = '',
        $address = '',
        $description = '',
        $examples = '',
        $references = '',
        $contact = '',
        $companyUrl = ''
    ) {
        $width = 197;
        
        $this->tcpdf->SetXY($x, $y);
        
        $this->tcpdf->SetTextColor(90, 90, 90);
        
        $this->tcpdf->SetFont($this->tcpdf->tahoma, '', 8);
        $this->tcpdf->Cell(50, 6, $date . ', ' . $company, 0, 0, 'L', false);
        
        $this->tcpdf->SetXY($x, $y += 4.5);
        $this->tcpdf->SetFont($this->tcpdf->tahomaBold, '', 9);
        $this->tcpdf->Cell(150, 6, $positionName, 0, 0, 'L', false);
        
        $this->tcpdf->SetTextColor(90, 90, 90);
        $this->tcpdf->SetFont($this->tcpdf->tahoma, '', 7);
        
        if (false === empty($references)) {
            $this->tcpdf->SetXY($x, $y + 1.5);
            $this->tcpdf->Cell(195, 2.2, 'References', '', 0, 'R', false, $references);
            $this->tcpdf->Image(PdfConfig::PATH_IMAGES . 'save.png', $this->tcpdf->GetX(), $y + 1.5, 2.5, 2.5, 'PNG', $references);
        }

        if (false === empty($examples)) {
            $shift = (false === empty($references) ? 17 : 0);
            $this->tcpdf->SetXY($x, $y + 1.5);
            $this->tcpdf->Cell(195 - $shift, 2.2, 'Examples', '', 0, 'R', false, $examples);
            $this->tcpdf->Image(PdfConfig::PATH_IMAGES . 'save.png', $this->tcpdf->GetX(), $y + 1.5, 2.5, 2.5, 'PNG', $examples);
        }
        
        $this->tcpdf->SetTextColor(90, 90, 90);
        $this->tcpdf->SetXY($x + 1.5, $y += 5.5);
        $this->tcpdf->SetFont($this->tcpdf->tahoma, '', 8);
        $this->tcpdf->MultiCell($width, 4, $description . "\r\n", 0, 'J', false);
        
        $this->tcpdf->SetTextColor(150, 150, 150);
        
        $y = $this->tcpdf->GetY() + 0.6;
        
        $urlWidth = 0;
        if (false === empty($companyUrl)) {
            $this->tcpdf->SetXY($x + 1, $y - 0.1);
            $this->tcpdf->SetFont($this->tcpdf->tahoma, '', 6.5);
            $this->tcpdf->Cell($width, 2, $companyUrl, 0, 0, 'R', false, $companyUrl);
            $urlWidth = (int)$this->tcpdf->GetStringWidth($companyUrl) + 0.3;
        }

        if (false === empty($contact)) {
            $this->tcpdf->SetXY($x + 1, $y - 0.1);
            $this->tcpdf->SetFont($this->tcpdf->tahoma, '', 6.5);
            $text = 'Contact: '
                .$contact
                .', '
                .$address
                .($urlWidth > 0 ? ', ' : '');
            
            $this->tcpdf->Cell($width - $urlWidth, 2, $text, 0, 0, 'R', false);
        }
        
        $this->tcpdf->cursorPositionY = $this->tcpdf->getY() + 4.3;
    }
}
