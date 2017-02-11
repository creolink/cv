<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Decorator\AbstractPageDecorator;
use Application\Helper\DateHelper;
use Application\Config\PersonalData;
use Application\Config\PdfConfig;
use Application\Config\Image;
use Application\Config\Color;
use Application\Config\Font;
use Application\Element\MainHeaderFullName;
use Application\Element\MainHeaderSpeciality;
use Application\Element\MainHeaderFlags;
use Application\Element\MainHeaderDownload;
use Application\Element\MainHeaderIcons;
use Application\Element\MainHeaderMostRecentInfo;

class MainHeader extends AbstractPageDecorator
{
    const CURSOR_X = 0;
    const CURSOR_Y = 0;
    
    const LINE_WIDTH = 0.1;
    
    const BACKGROUND_WIDTH = 210;
    const BACKGROUND_HEIGHT = 45;
    const BACKGROUND_STYLE = 'F';
    
    /**
     * {@inheritDoc}
     */
    public function addElements()
    {
        $this->tcpdf = $this->tcpdf->addElements();
        
        return $this->renderMainHeader();
    }
    
    /**
     * Creates Main CV Header
     */
    private function renderMainHeader()
    {
        $this->configure();
        
        $this->renderBackground();
        $this->renderTitle();
        $this->renderFlags();
        $this->renderDownloadButton();
        $this->renderContactData();
        $this->renderPersonalPhoto();
        $this->renderMostRecentInfo();
        $this->renderPersonalData();
        
        return $this->tcpdf;
    }
    
    /**
     * Configures header element
     */
    private function configure()
    {
        $this->tcpdf->SetXY(
            self::CURSOR_X,
            self::CURSOR_Y
        );
        
        $this->tcpdf->SetLineWidth(
            self::LINE_WIDTH
        );
        
        $this->tcpdf->SetDrawColor(
            Color::DRAW_COLOR_BRIGHT_RED,
            Color::DRAW_COLOR_BRIGHT_GREEN,
            Color::DRAW_COLOR_BRIGHT_BLUE
        );
    }
    
    /**
     * Renders header background
     */
    private function renderBackground()
    {
        $this->tcpdf->SetFillColor(
            Color::FILL_COLOR_BRIGHT_RED,
            Color::FILL_COLOR_BRIGHT_GREEN,
            Color::FILL_COLOR_BRIGHT_BLUE
        );
        
        $this->tcpdf->Rect(
            self::CURSOR_X,
            self::CURSOR_Y,
            self::BACKGROUND_WIDTH,
            self::BACKGROUND_HEIGHT,
            self::BACKGROUND_STYLE
        );
    }
    
    /**
     * Renders CV title
     */
    private function renderTitle()
    {
        $mainHeaderFullName = new MainHeaderFullName($this->tcpdf);
        $mainHeaderFullName->renderTitle();
        
        $mainHeaderSpeciality = new MainHeaderSpeciality($this->tcpdf);
        $mainHeaderSpeciality->renderSpeciality();
        
        $MainHeaderTools = new MainHeaderTools($this->tcpdf);
        $MainHeaderTools->renderTools();
    }

    /**
     * Renders flags / cv languages & urls
     */
    private function renderFlags()
    {
        $mainHeaderFlags = new MainHeaderFlags($this->tcpdf);
        $mainHeaderFlags->renderFlags();
    }
    
    /**
     * Renders download button
     */
    private function renderDownloadButton()
    {
        $mainHeaderDownload = new MainHeaderDownload($this->tcpdf);
        $mainHeaderDownload->renderDownloadButton();
    }
    
    /**
     * Renders contact icons
     */
    private function renderContactData()
    {
        $mainHeaderIcons = new MainHeaderIcons($this->tcpdf);
        $mainHeaderIcons->renderContactData();
    }
    
    /**
     * Renders personal photo in header
     */
    private function renderPersonalPhoto()
    {
        $mainHeaderPersonalPhoto = new MainHeaderPersonalPhoto($this->tcpdf);
        $mainHeaderPersonalPhoto->renderPersonalPhoto();
    }
    
    /**
     * Renders information about most recent CV
     */
    private function renderMostRecentInfo()
    {
        $mainHeaderMostRecentInfo = new MainHeaderMostRecentInfo($this->tcpdf);
        $mainHeaderMostRecentInfo->renderMostRecentInfo();
    }
    
    /**
     * Renders personal data
     */
    private function renderPersonalData()
    {
        $dateHelper = new DateHelper(
            strtotime(PersonalData::BIRTH_DATE)
        );
        
        $posYBox = 5;
        
        $this->tcpdf->SetFont($this->tcpdf->dejavu, '', 8);
        $this->tcpdf->SetTextColor(50, 50, 50);
        $this->tcpdf->SetFillColor(235,235,235);
        $this->tcpdf->SetLineWidth(0.1);

        $this->renderPersonalDataRow(
            'Experience',
            $dateHelper->getPassedYears(PersonalData::WORK_START_YEAR) . ' years',
            $posYBox
        );
        
        $this->renderPersonalDataRow(
            'Date of birth',
            $dateHelper->getDate(),
            $posYBox += 5
        );
        
        $this->renderPersonalDataRow(
            'Nationality',
            PersonalData::NATIONALITY,
            $posYBox += 5
        );
        
        $this->renderPersonalDataRow(
            'Location',
            PersonalData::COUNTRY,
            $posYBox += 5
        );
        
        $this->renderPersonalDataRow(
            'Address',
            PersonalData::STREET . "\n" . PersonalData::POST_CODE . ' ' . PersonalData::CITY,
            $posYBox += 5
        );
        
        $this->renderPersonalDataRow(
            'Workplace',
            PersonalData::WORK_PLACE,
            $posYBox += 8
        );
    }
    
    /**
     * @param string $name
     * @param string $text
     * @param float $y
     */
    private function renderPersonalDataRow($name, $text, $y)
    {
        $this->renderPersonalDataBox($name, $y);
        $this->renderPersonalDataText($text, $y);
    }
    
    /**
     * @param string $name
     * @param float $y
     */
    private function renderPersonalDataBox($name, $y)
    {
        $this->tcpdf->RoundedRect(152, $y, 22, 4, 1, '1111', 'DF');
        
        $this->tcpdf->SetXY(152, $y - 1);
        $this->tcpdf->Cell(10, 6, $name, 0, 0, 'L', false);
    }
    
    /**
     * @param string $text
     * @param float $y
     */
    private function renderPersonalDataText($text, $y)
    {
        $this->tcpdf->SetXY($this->tcpdf->getX() + 12, $y + 0.2);
        $this->tcpdf->MultiCell(35, 6, $text , 0, 'L', false);
    }
}