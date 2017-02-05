<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\AbstractSection;
use Application\Entity\EmploymentPosition;
use Application\Config\Color;
use Application\Config\Font;
use Application\Config\Image;
use Application\Hydrator\Hydrator;

abstract class AbstractEmployment extends AbstractSection
{
    const SECTION_WIDTH = 197;
    
    const FIRST_POSITION_MARGIN = -1;
    const NEXT_POSITION_MARGIN = 2;
    
    const DATE_FONT_SIZE = 8;
    const DATE_CELL_WIDTH = 0;
    const DATE_CELL_HEIGHT = 6;
    const DATE_SEPARATOR = ' - ';
    
    const NAME_MARGIN = 4.5;
    const NAME_FONT_SIZE = 9;
    const NAME_CELL_WIDTH = 150;
    const NAME_CELL_HEIGHT = 6;
    
    const REFERENCES_MARGIN = 5.5;
    const REFERENCES_CELL_WIDTH = 195;
    const REFERENCES_CELL_HEIGHT = 2.2;
    
    const EXAMPLES_CELL_WIDTH = 195;
    const EXAMPLES_CELL_HEIGHT = 2.2;
    const EXAMPLES_CELL_PADDING = 17;
    const EXAMPLES_CELL_NO_PADDING = 0;
    const EXAMPLES_MARGIN = 5.5;
    
    const DOWNLOAD_ICON_MARGIN = 5.5;
    const DOWNLOAD_DOCUMENT_FONT_SIZE = 7;
    
    const DESCRIPTION_MARGIN_X = 1.5;
    const DESCRIPTION_MARGIN_Y = 10;
    const DESCRIPTION_FONT_SIZE = 8;
    const DESCRIPTION_LINE_HEIGHT = 4;
    
    const COMPANY_DATA_FONT_SIZE = 6.5;
    const COMPANY_DATA_MARGIN_Y = 0.5;
    const COMPANY_DATA_MARGIN_X = 1;
    const COMPANY_DATA_PADDING = 2.5;
    
    const COMPANY_URL_MARGIN = 0.3;
    const COMPANY_URL_LINE_HEIGHT = 2;
    
    const CONTACT_SEPARATOR = ', ';
    const CONTACT_CELL_HEIGHT = 2;
    
    const DATE_AND_COMPANY_SEPARATOR = ', ';
    
    /**
     * @var float
     */
    private $companyUrlWidth = 0;
    
    /**
     * Renders list of skills
     * 
     * @param Hydrator $hydrator
     */
    protected function renderPositions(Hydrator $hydrator)
    {
        $x = $this->tcpdf->GetX();

        $counter = 0;

        foreach ($hydrator->getList() as $position) {
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
        return $this->getDate($position) . self::DATE_AND_COMPANY_SEPARATOR . $position->getCompany();
    }
    
    /**
     * @param EmploymentPosition $position
     * @return string
     */
    private function getDate(EmploymentPosition $position)
    {
        $dateEnd = $position->getDateEnd();
        
        return $position->getDateStart()
            . self::DATE_SEPARATOR
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
            $references = $position->getReferences();
            
            $this->setDownloadDocumentText();
            
            $this->tcpdf->SetXY($x, $y + self::REFERENCES_MARGIN);

            $this->tcpdf->Cell(
                self::REFERENCES_CELL_WIDTH,
                self::REFERENCES_CELL_HEIGHT,
                'References',
                self::BORDER_NONE,
                self::CELL_LINE_NONE,
                self::ALIGN_RIGHT,
                self::TRANSPARENT,
                $references
            );
            
            $this->renderDownloadIcon($y, $references);
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

            $this->setDownloadDocumentText();

            $margin = $position->hasReferences() ? self::EXAMPLES_CELL_PADDING : self::EXAMPLES_CELL_NO_PADDING;
            
            $this->tcpdf->SetXY($x, $y + self::EXAMPLES_MARGIN);
            
            $this->tcpdf->Cell(
                self::EXAMPLES_CELL_WIDTH - $margin,
                self::EXAMPLES_CELL_HEIGHT,
                'Examples',
                self::BORDER_NONE,
                self::CELL_LINE_NONE,
                self::ALIGN_RIGHT,
                self::TRANSPARENT,
                $examples
            );
            
            $this->renderDownloadIcon($y, $examples);
        }
    }
    
    /**
     * Sets fonts color and size for downloadable documents
     *  like references or examples
     */
    private function setDownloadDocumentText()
    {
        $this->tcpdf->SetTextColor(
            Color::TEXT_COLOR_MEDIUM_RED,
            Color::TEXT_COLOR_MEDIUM_GREEN,
            Color::TEXT_COLOR_MEDIUM_BLUE
        );

        $this->tcpdf->SetFont(
            $this->tcpdf->tahoma,
            Font::NORMAL,
            self::DOWNLOAD_DOCUMENT_FONT_SIZE
        );
    }
    
    /**
     * Renders save image with proper link
     * 
     * @param float $y
     * @param type $link
     */
    private function renderDownloadIcon($y, $link = '')
    {
        $this->tcpdf->renderImage(
            Image::DOWNLOAD,
            $this->tcpdf->GetX(),
            $y + self::DOWNLOAD_ICON_MARGIN,
            Image::DOWNLOAD_WIDTH,
            Image::DOWNLOAD_HEIGHT,
            $link
        );
    }
    
    /**
     * Renders description of position
     * 
     * @param EmploymentPosition $position
     * @param float $x
     * @param float $y
     */
    private function renderDescription(EmploymentPosition $position, $x, $y)
    {
        $this->tcpdf->SetXY(
            $x + self::DESCRIPTION_MARGIN_X,
            $y + self::DESCRIPTION_MARGIN_Y
        );
        
        $this->tcpdf->SetTextColor(
            Color::TEXT_COLOR_MEDIUM_RED,
            Color::TEXT_COLOR_MEDIUM_GREEN,
            Color::TEXT_COLOR_MEDIUM_BLUE
        );
        
        $this->tcpdf->SetFont(
            $this->tcpdf->tahoma,
            Font::NORMAL,
            self::DESCRIPTION_FONT_SIZE
        );
        
        $this->tcpdf->MultiCell(
            self::SECTION_WIDTH,
            self::DESCRIPTION_LINE_HEIGHT,
            $position->getDescription() . self::NEW_LINE
        );
    }
    
    /**
     * Renders company data: address, phone, email, person, url, etc..
     * 
     * @param EmploymentPosition $position
     * @param float $x
     * @param float $y
     */
    private function renderCompanyData(EmploymentPosition $position, $x)
    {
        if ($position->hasCompanyData()) {
            $this->tcpdf->SetTextColor(
                Color::TEXT_COLOR_LIGHT_RED,
                Color::TEXT_COLOR_LIGHT_GREEN,
                Color::TEXT_COLOR_LIGHT_BLUE
            );
            
            $this->tcpdf->SetFont(
                $this->tcpdf->tahoma,
                Font::NORMAL,
                self::COMPANY_DATA_FONT_SIZE
            );

            $y = $this->tcpdf->GetY() + self::COMPANY_DATA_MARGIN_Y;

            $this->renderCompanyUrl(
                $position,
                $x + self::COMPANY_DATA_MARGIN_X,
                $y
            );
            
            $this->renderContact(
                $position,
                $x + self::COMPANY_DATA_MARGIN_X,
                $y
            );
            
            $this->tcpdf->SetXY(
                $x,
                $y + self::COMPANY_DATA_PADDING
            );
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
            
            $this->companyUrlWidth = $this->tcpdf->GetStringWidth($companyUrl) + self::COMPANY_URL_MARGIN;
            
            $this->tcpdf->Cell(
                self::SECTION_WIDTH,
                self::COMPANY_URL_LINE_HEIGHT,
                $companyUrl,
                self::BORDER_NONE,
                self::CELL_LINE_NONE,
                self::ALIGN_RIGHT,
                self::TRANSPARENT,
                $companyUrl
            );
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

            $this->tcpdf->Cell(
                self::SECTION_WIDTH - $this->companyUrlWidth,
                self::CONTACT_CELL_HEIGHT,
                $this->createContactText($position),
                self::BORDER_NONE,
                self::CELL_LINE_NONE,
                self::ALIGN_RIGHT
            );
        }
    }
    
    /**
     * @param EmploymentPosition $position
     * @return string
     */
    private function createContactText(EmploymentPosition $position)
    {
        $text = 'Contact: ';

        if ($position->hasContact()) {
            $text .= $position->getContact();
        }

        if ($position->hasContact() && $position->hasAddress()) {
            $text .= self::CONTACT_SEPARATOR;
        }

        if ($position->hasAddress()) {
            $text .= $position->getAddress();
        }

        if ($this->companyUrlWidth > 0) {
            $text .= self::CONTACT_SEPARATOR;
        }
        
        return $text;
    }
}
