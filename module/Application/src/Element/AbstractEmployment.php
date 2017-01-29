<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\AbstractSection;
use Application\Config\PdfConfig;

abstract class AbstractEmployment extends AbstractSection
{
    const SECTION_WIDTH = 197;
    
    /**
     * @var float
     */
    private $urlWidth = 0;
    
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
        $this->renderDateAndCompany($x, $y, $date, $company);
        $this->renderPositionName($x, $y, $positionName);
        $this->renderReferences($x, $y, $references);
        $this->renderExamples($x, $y, $examples, $references);
        $this->renderDescription($x, $y, $description);
        $this->renderCompanyUrl($x, $y, $companyUrl);
        $this->renderContact($x, $y, $contact, $address);
        $this->setCursor();
    }
    
    private function setCursor()
    {
        $this->tcpdf->cursorPositionY = $this->tcpdf->getY() + 4.3;
    }
    
    private function renderDateAndCompany($x, $y, $date, $company)
    {
        $this->tcpdf->SetXY($x, $y);
        $this->tcpdf->SetTextColor(90, 90, 90);
        $this->tcpdf->SetFont($this->tcpdf->tahoma, '', 8);
        $this->tcpdf->Cell(50, 6, $date . ', ' . $company, 0, 0, 'L', false);
    }
    
    private function renderPositionName($x, $y, $positionName)
    {
        $this->tcpdf->SetXY($x, $y += 4.5);        
        $this->tcpdf->SetTextColor(90, 90, 90);
        $this->tcpdf->SetFont($this->tcpdf->tahomaBold, '', 9);
        $this->tcpdf->Cell(150, 6, $positionName, 0, 0, 'L', false);
    }
    
    private function renderReferences($x, $y, $references)
    {
        $this->tcpdf->SetTextColor(90, 90, 90);
        $this->tcpdf->SetFont($this->tcpdf->tahoma, '', 7);
        
        if (false === empty($references)) {
            $this->tcpdf->SetXY($x, $y + 1.5);
            $this->tcpdf->Cell(195, 2.2, 'References', '', 0, 'R', false, $references);
            $this->tcpdf->Image(PdfConfig::PATH_IMAGES . 'save.png', $this->tcpdf->GetX(), $y + 1.5, 2.5, 2.5, 'PNG', $references);
        }
    }
    
    private function renderExamples($x, $y, $examples, $references)
    {
        $this->tcpdf->SetTextColor(90, 90, 90);
        $this->tcpdf->SetFont($this->tcpdf->tahoma, '', 7);
        
        if (false === empty($examples)) {
            $shift = (false === empty($references) ? 17 : 0);
            $this->tcpdf->SetXY($x, $y + 1.5);
            $this->tcpdf->Cell(195 - $shift, 2.2, 'Examples', '', 0, 'R', false, $examples);
            $this->tcpdf->Image(PdfConfig::PATH_IMAGES . 'save.png', $this->tcpdf->GetX(), $y + 1.5, 2.5, 2.5, 'PNG', $examples);
        }
    }
    
    private function renderDescription($x, $y, $description)
    {
        $this->tcpdf->SetTextColor(90, 90, 90);
        $this->tcpdf->SetXY($x + 1.5, $y += 5.5);
        $this->tcpdf->SetFont($this->tcpdf->tahoma, '', 8);
        $this->tcpdf->MultiCell(self::SECTION_WIDTH, 4, $description . "\r\n", 0, 'J', false);
    }
    
    private function renderCompanyUrl($x, $y, $companyUrl)
    {
        $this->tcpdf->SetTextColor(150, 150, 150);
        
        $y = $this->tcpdf->GetY() + 0.6;
        
        if (false === empty($companyUrl)) {
            $this->tcpdf->SetXY($x + 1, $y - 0.1);
            $this->tcpdf->SetFont($this->tcpdf->tahoma, '', 6.5);
            $this->tcpdf->Cell(self::SECTION_WIDTH, 2, $companyUrl, 0, 0, 'R', false, $companyUrl);
            $this->urlWidth = $this->tcpdf->GetStringWidth($companyUrl) + 0.3;
        }
    }
    
    private function renderContact($x, $y, $contact, $address)
    {
        $this->tcpdf->SetTextColor(150, 150, 150);
        
        $y = $this->tcpdf->GetY() + 0.6;
        
        if (false === empty($contact)) {
            $this->tcpdf->SetXY($x + 1, $y - 0.1);
            $this->tcpdf->SetFont($this->tcpdf->tahoma, '', 6.5);
            $text = 'Contact: '
                .$contact
                .', '
                .$address
                .($this->urlWidth > 0 ? ', ' : '');
            
            $this->tcpdf->Cell(self::SECTION_WIDTH - $this->urlWidth, 2, $text, 0, 0, 'R', false);
        }
    }
}
