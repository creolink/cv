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
use Application\Config\Color;
use Application\Config\Font;

abstract class AbstractEmployment extends AbstractSection
{
    const SECTION_WIDTH = 197;
    
    const FIRST_POSITION_MARGIN = -1;
    const NEXT_POSITION_MARGIN = 2;
    
    const DATE_FONT_SIZE = 8;
    const DATE_CELL_WIDTH = 0;
    const DATE_CELL_HEIGHT = 6;
    
    const NAME_MARGIN = 4.5;
    const NAME_FONT_SIZE = 9;
    const NAME_CELL_WIDTH = 150;
    const NAME_CELL_HEIGHT = 6;
    
    const REFERENCES_MARGIN = 5.5;
    const REFERENCES_FONT_SIZE = 7;
    const REFERENCES_CELL_WIDTH = 195;
    const REFERENCES_CELL_HEIGHT = 2.2;
    
    /**
     * @var float
     */
    private $companyUrlWidth = 0;
    
    /**
     * Renders list of skills
     * 
     * @param EmploymentPosition[] $positions
     */
    protected function renderPositions(array $positions = [])
    {
        $x = $this->tcpdf->GetX();

        $counter = 0;

        foreach ($positions as $position) {
            if ($position->isDisabled()) {
                continue;
            }
            
            $this->renderPosition(
                $position,
                $x,
                $this->tcpdf->GetY() + $this->calculatePositionMargin($counter++)
            );
        }
    }
    
    /**
     * @param int $counter
     * @return float
     */
    private function calculatePositionMargin($counter = 0)
    {
        return ($counter) > 0
                ? self::NEXT_POSITION_MARGIN + self::FIRST_POSITION_MARGIN
                : self::FIRST_POSITION_MARGIN;
    }
    
    /**
     * @param EmploymentPosition $position
     * @param float $x
     * @param float $y
     */
    private function renderPosition(EmploymentPosition $position, $x, $y)
    {
        $this->renderDateAndCompany($position, $x, $y);
        $this->renderPositionName($position, $x, $y);
        $this->renderReferences($position, $x, $y);
        $this->renderExamples($position, $x, $y);
        $this->renderDescription($position, $x, $y);
        $this->renderCompanyData($position, $x);
    }
    
    /**
     * @param EmploymentPosition $position
     * @param float $x
     * @param float $y
     */
    private function renderDateAndCompany(EmploymentPosition $position, $x, $y)
    {
        $this->tcpdf->SetXY($x, $y);
        
        $this->tcpdf->SetTextColor(
            Color::TEXT_COLOR_MEDIUM_RED,
            Color::TEXT_COLOR_MEDIUM_GREEN,
            Color::TEXT_COLOR_MEDIUM_BLUE
        );
        
        $this->tcpdf->SetFont(
            $this->tcpdf->tahoma,
            Font::NORMAL,
            self::DATE_FONT_SIZE
        );
        
        $this->tcpdf->Cell(
            self::DATE_CELL_WIDTH,
            self::DATE_CELL_HEIGHT,
            $this->getDateAndCompany($position)
        );
    }
    
    /**
     * @param EmploymentPosition $position
     * @return string
     */
    private function getDateAndCompany(EmploymentPosition $position)
    {
        return $this->getDate($position) . ', ' . $position->getCompany();
    }
    
    /**
     * @param EmploymentPosition $position
     * @return string
     */
    private function getDate(EmploymentPosition $position)
    {
        $dateEnd = $position->getDateEnd();
        
        return $position->getDateStart()
            . ' - '
            . (false === empty($dateEnd) ? $dateEnd : '...present');
    }
    
    /**
     * @param EmploymentPosition $position
     * @param float $x
     * @param float $y
     */
    private function renderPositionName(EmploymentPosition $position, $x, $y)
    {
        $this->tcpdf->SetXY($x, $y + self::NAME_MARGIN);
        
        $this->tcpdf->SetTextColor(
            Color::TEXT_COLOR_MEDIUM_RED,
            Color::TEXT_COLOR_MEDIUM_GREEN,
            Color::TEXT_COLOR_MEDIUM_BLUE
        );
        
        $this->tcpdf->SetFont(
            $this->tcpdf->tahomaBold,
            Font::NORMAL,
            self::NAME_FONT_SIZE
        );
        
        $this->tcpdf->Cell(
            self::NAME_CELL_WIDTH,
            self::NAME_CELL_HEIGHT,
            $position->getName()
        );
    }
    
    /**
     * @param EmploymentPosition $position
     * @param float $x
     * @param float $y
     */
    private function renderReferences(EmploymentPosition $position, $x, $y)
    {
        if ($position->hasReferences()) {
            $this->tcpdf->SetXY($x, $y + self::REFERENCES_MARGIN);
            
            $references = $position->getReferences();

            $this->tcpdf->SetTextColor(
                Color::TEXT_COLOR_MEDIUM_RED,
                Color::TEXT_COLOR_MEDIUM_GREEN,
                Color::TEXT_COLOR_MEDIUM_BLUE
            );

            $this->tcpdf->SetFont(
                $this->tcpdf->tahoma,
                Font::NORMAL,
                self::REFERENCES_FONT_SIZE
            );

            $this->tcpdf->Cell(
                self::REFERENCES_CELL_WIDTH,
                self::REFERENCES_CELL_HEIGHT,
                'References',
                self::BORDER_NONE,
                self::CELL_LINE_NONE,
                self::ALIGN_RIGHT,
                self::NOT_FILLED,
                $references
            );
            
            $this->tcpdf->Image(
                PdfConfig::PATH_IMAGES . 'save.png',
                $this->tcpdf->GetX(),
                $y + 5.5,
                2.5,
                2.5,
                'PNG',
                $references
            );
        }
    }
    
    /**
     * @param EmploymentPosition $position
     * @param float $x
     * @param float $y
     */
    private function renderExamples(EmploymentPosition $position, $x, $y)
    {
        if ($position->hasExamples()) {
            $examples = $position->getExamples();

            $this->tcpdf->SetTextColor(90, 90, 90);
            $this->tcpdf->SetFont($this->tcpdf->tahoma, '', 7);

            $shift = ($position->hasReferences() ? 17 : 0);
            $this->tcpdf->SetXY($x, $y + 5.5);
            $this->tcpdf->Cell(195 - $shift, 2.2, 'Examples', '', 0, 'R', false, $examples);
            $this->tcpdf->Image(PdfConfig::PATH_IMAGES . 'save.png', $this->tcpdf->GetX(), $y + 5.5, 2.5, 2.5, 'PNG', $examples);
        }
    }
    
    /**
     * @param EmploymentPosition $position
     * @param float $x
     * @param float $y
     */
    private function renderDescription(EmploymentPosition $position, $x, $y)
    {
        $this->tcpdf->SetXY($x + 1.5, $y + 10);
        $this->tcpdf->SetTextColor(90, 90, 90);
        $this->tcpdf->SetFont($this->tcpdf->tahoma, '', 8);
        $this->tcpdf->MultiCell(self::SECTION_WIDTH, 4, $position->getDescription() . "\r\n");
    }
    
    /**
     * @param EmploymentPosition $position
     * @param float $x
     * @param float $y
     */
    private function renderCompanyData(EmploymentPosition $position, $x)
    {
        if ($position->hasCompanyData()) {
            $this->tcpdf->SetTextColor(150, 150, 150);
            $this->tcpdf->SetFont($this->tcpdf->tahoma, '', 6.5);

            $y = $this->tcpdf->GetY() + 0.5;

            $this->renderCompanyUrl($position, $x + 1, $y);
            $this->renderContact($position, $x + 1, $y);
            
            $this->tcpdf->SetXY($x + 1, $y + 2.5);
        }
    }
    
    /**
     * @param EmploymentPosition $position
     * @param float $x
     * @param float $y
     */
    private function renderCompanyUrl(EmploymentPosition $position, $x, $y)
    {
        $this->companyUrlWidth = 0;
        
        if ($position->hasCompanyUrl()) {
            $this->tcpdf->SetXY($x, $y);
            $companyUrl = $position->getCompanyUrl();
            $this->companyUrlWidth = $this->tcpdf->GetStringWidth($companyUrl) + 0.3;
            $this->tcpdf->Cell(self::SECTION_WIDTH, 2, $companyUrl, 0, 0, 'R', false, $companyUrl);
        }
    }
    
    /**
     * @param EmploymentPosition $position
     * @param float $x
     * @param float $y
     */
    private function renderContact(EmploymentPosition $position, $x, $y)
    {
        if ($position->hasContact() || $position->hasAddress()) {
            $this->tcpdf->SetXY($x, $y);
            
            $text = 'Contact: '
                . $position->getContact()
                . ($position->hasContact() && $position->hasAddress() ? ', ' : '')
                . $position->getAddress()
                . ($this->companyUrlWidth > 0 ? ', ' : '');
            
            $this->tcpdf->Cell(self::SECTION_WIDTH - $this->companyUrlWidth, 2, $text, 0, 0, 'R');
        }
    }
}
