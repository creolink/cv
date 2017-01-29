<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\AbstractSection;
use Application\Config\PdfConfig;
use Application\Entity\EmploymentPosition;
use Application\Hydrator\Hydrator;

abstract class AbstractEmployment extends AbstractSection
{
    const SECTION_WIDTH = 197;
    
    const POSITION_MARGIN = 4;
    
    /**
     * @var float
     */
    private $companyUrlWidth = 0;
    
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
        $this->renderCompanyData($x, $companyUrl, $contact, $address);
        
        $this->setCursor();
    }
    
    /**
     * Renders list of skills
     * 
     * @param EmploymentPosition[] $positions
     */
    protected function renderPositions($positions)
    {
        $x = $this->tcpdf->GetX();

        $counter = 0;

        foreach ($positions as $position) {
            if ($position->isDisabled()) {
                continue;
            }
            
            $positionMargin = ($counter++) > 0 ? self::POSITION_MARGIN : 0;
            
            $this->renderPosition(
                $position,
                $x,
                $this->tcpdf->GetY() - 1 + $positionMargin
            );
        }
    }
    
    /**
     * @param EmploymentPosition $position
     * @param float $x
     * @param float $y
     */
    private function renderPosition(EmploymentPosition $position, $x, $y)
    {
        $this->renderDateAndCompany($x, $y, $position->getDateStart(), $position->getCompany(), $position->getDateEnd());
        $this->renderPositionName($x, $y, $position->getName());
        $this->renderReferences($x, $y, $position->getReferences());
        $this->renderExamples($x, $y, $position->getExamples(), $position->getReferences());
        $this->renderDescription($x, $y, $position->getDescription());
        $this->renderCompanyData($x, $position->getCompanyUrl(), $position->getContact(), $position->getAddress());
        
        $this->setCursor();
    }
    
    private function setCursor()
    {
        $this->tcpdf->cursorPositionY = $this->tcpdf->getY() + 4.3;
    }
    
    private function renderDateAndCompany($x, $y, $dateStart, $company, $dateEnd)
    {
        $this->tcpdf->SetXY($x, $y);
        $this->tcpdf->SetTextColor(90, 90, 90);
        $this->tcpdf->SetFont($this->tcpdf->tahoma, '', 8);
        
        $this->tcpdf->Cell(
            50,
            6,
            $this->getDate($dateStart, $dateEnd) . ', ' . $company
        );
    }
    
    private function getDate($dateStart, $dateEnd)
    {
        return $dateStart
            . ' - '
            . (false === empty($dateEnd) ? $dateEnd : '...present');
    }
    
    private function renderPositionName($x, $y, $positionName)
    {
        $this->tcpdf->SetXY($x, $y + 4.5);
        $this->tcpdf->SetTextColor(90, 90, 90);
        $this->tcpdf->SetFont($this->tcpdf->tahomaBold, '', 9);
        $this->tcpdf->Cell(150, 6, $positionName);
    }
    
    private function renderReferences($x, $y, $references)
    {
        $this->tcpdf->SetTextColor(90, 90, 90);
        $this->tcpdf->SetFont($this->tcpdf->tahoma, '', 7);
        
        if (false === empty($references)) {
            $this->tcpdf->SetXY($x, $y + 5.5);
            $this->tcpdf->Cell(195, 2.2, 'References', '', 0, 'R', false, $references);
            $this->tcpdf->Image(PdfConfig::PATH_IMAGES . 'save.png', $this->tcpdf->GetX(), $y + 5.5, 2.5, 2.5, 'PNG', $references);
        }
    }
    
    private function renderExamples($x, $y, $examples, $references)
    {
        $this->tcpdf->SetTextColor(90, 90, 90);
        $this->tcpdf->SetFont($this->tcpdf->tahoma, '', 7);
        
        if (false === empty($examples)) {
            $shift = (false === empty($references) ? 17 : 0);
            $this->tcpdf->SetXY($x, $y + 5.5);
            $this->tcpdf->Cell(195 - $shift, 2.2, 'Examples', '', 0, 'R', false, $examples);
            $this->tcpdf->Image(PdfConfig::PATH_IMAGES . 'save.png', $this->tcpdf->GetX(), $y + 5.5, 2.5, 2.5, 'PNG', $examples);
        }
    }
    
    private function renderDescription($x, $y, $description)
    {
        $this->tcpdf->SetXY($x + 1.5, $y + 10);
        $this->tcpdf->SetTextColor(90, 90, 90);
        $this->tcpdf->SetFont($this->tcpdf->tahoma, '', 8);
        $this->tcpdf->MultiCell(self::SECTION_WIDTH, 4, $description . "\r\n");
    }
    
    private function renderCompanyData($x, $companyUrl, $contact, $address)
    {
        $this->tcpdf->SetTextColor(150, 150, 150);
        $this->tcpdf->SetFont($this->tcpdf->tahoma, '', 6.5);
        
        $y = $this->tcpdf->GetY() + 0.5;
        
        $this->renderCompanyUrl($x + 1, $y, $companyUrl);
        $this->renderContact($x + 1, $y, $contact, $address);
    }
    
    private function renderCompanyUrl($x, $y, $companyUrl)
    {
        if (false === empty($companyUrl)) {
            $this->tcpdf->SetXY($x, $y);
            $this->companyUrlWidth = $this->tcpdf->GetStringWidth($companyUrl) + 0.3;
            $this->tcpdf->Cell(self::SECTION_WIDTH, 2, $companyUrl, 0, 0, 'R', false, $companyUrl);
        }
    }
    
    private function renderContact($x, $y, $contact, $address)
    {
        $isContact = false === empty($contact);
        $isAddress = false === empty($address);
        
        if ($isContact || $isAddress) {
            $this->tcpdf->SetXY($x, $y);
            
            $text = 'Contact: '
                . $contact
                . ($isContact && $isAddress ? ', ' : '')
                . $address
                . ($this->companyUrlWidth > 0 ? ', ' : '');
            
            $this->tcpdf->Cell(self::SECTION_WIDTH - $this->companyUrlWidth, 2, $text, 0, 0, 'R');
        }
    }
}
