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

class MainHeader extends AbstractPageDecorator
{
    const CURSOR_X = 0;
    const CURSOR_Y = 0;
    
    const LINE_WIDTH = 0.1;
    
    const BACKGROUND_WIDTH = 210;
    const BACKGROUND_HEIGHT = 45;
    const BACKGROUND_STYLE = 'F';
    
    const FLAGS_CURSOR_X = 11;
    const FLAGS_CURSOR_Y = 6;
    
    const FLAG_EN_MARGIN = 0;
    const FLAG_DE_MARGIN = 4;
    const FLAG_PL_MARGIN = 8;
    
    const DOWNLOAD_CURSOR_X = 12;
    const DOWNLOAD_CURSOR_Y = 18;
    
    const CONTACT_ICON_CURSOR_Y = 40;
    const CONTACT_ICON_PHONE_CURSOR_X = 58;
    const CONTACT_ICON_EMAIL_CURSOR_X = 86;
    const CONTACT_ICON_SKYPE_CURSOR_X = 123;
    const CONTACT_ICON_LINKED_IN_CURSOR_X = 152;
    const CONTACT_ICON_GOLDEN_LINE_CURSOR_X = 177;
    
    const CONTACT_LINE_UP_CURSOR_X_START = 0;
    const CONTACT_LINE_UP_CURSOR_X_END = 210;
    const CONTACT_LINE_UP_CURSOR_Y = 39;
    
    const CONTACT_LINE_DOWN_CURSOR_X_START = 0;
    const CONTACT_LINE_DOWN_CURSOR_X_END = 210;
    const CONTACT_LINE_DOWN_CURSOR_Y = 45;
    
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
        $this->renderPersonalDataPhoto();
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
        $this->renderFlag(
            Image::FLAG_EN,
            'en',
            self::FLAG_EN_MARGIN
        );
        
        $this->renderFlag(
            Image::FLAG_DE,
            'de',
            self::FLAG_DE_MARGIN
        );
        
        $this->renderFlag(
            Image::FLAG_PL,
            'pl',
            self::FLAG_PL_MARGIN
        );
    }
    
    /**
     * Renders flag with url
     * 
     * @param string $flag
     * @param string $language
     * @param float $margin
     */
    private function renderFlag($flag = '', $language = '', $margin = 0)
    {
        $this->tcpdf->renderImage(
            $flag,
            self::FLAGS_CURSOR_X,
            self::FLAGS_CURSOR_Y + $margin,
            Image::FLAG_WIDTH,
            Image::FLAG_HEIGHT,
            'http://'.$_SERVER['SERVER_NAME'].'/?' . $language
        );
        
        $this->tcpdf->Rect(
            self::FLAGS_CURSOR_X,
            self::FLAGS_CURSOR_Y + $margin,
            Image::FLAG_WIDTH,
            Image::FLAG_HEIGHT
        );
    }
    
    /**
     * Renders download button
     */
    private function renderDownloadButton()
    {
        if (false === $this->tcpdf->isDownloaded) {
            $this->tcpdf->renderImage(
                Image::DOWNLOAD,
                self::DOWNLOAD_CURSOR_X,
                self::DOWNLOAD_CURSOR_Y,
                Image::DOWNLOAD_WIDTH,
                Image::DOWNLOAD_HEIGHT,
                'http://'.$_SERVER['SERVER_NAME'].'/?download&en'
            ); 
        }
    }
    
    private function renderContactData()
    {
        $this->tcpdf->SetTextColor(
            Color::TEXT_COLOR_DARK_RED,
            Color::TEXT_COLOR_DARK_GREEN,
            Color::TEXT_COLOR_DARK_BLUE
        );
        
        $this->tcpdf->renderIcon(
            self::CONTACT_ICON_PHONE_CURSOR_X,
            self::CONTACT_ICON_CURSOR_Y,
            Image::PHONE,
            PersonalData::PHONE,
            PersonalData::PHONE_URL
        );
        
        $this->tcpdf->renderIcon(
            self::CONTACT_ICON_EMAIL_CURSOR_X,
            self::CONTACT_ICON_CURSOR_Y,
            Image::EMAIL,
            PersonalData::EMAIL,
            PersonalData::EMAIL_URL
        );
        
        $this->tcpdf->renderIcon(
            self::CONTACT_ICON_SKYPE_CURSOR_X,
            self::CONTACT_ICON_CURSOR_Y,
            Image::SKYPE,
            PersonalData::SKYPE,
            PersonalData::SKYPE_URL
        );
        
        $this->tcpdf->renderIcon(
            self::CONTACT_ICON_LINKED_IN_CURSOR_X,
            self::CONTACT_ICON_CURSOR_Y,
            Image::LINKED_IN,
            PersonalData::LINKED_IN,
            PersonalData::LINKED_IN_URL
        );
        
        $this->tcpdf->renderIcon(
            self::CONTACT_ICON_GOLDEN_LINE_CURSOR_X,
            self::CONTACT_ICON_CURSOR_Y,
            Image::GOLDEN_LINE,
            PersonalData::GOLDEN_LINE,
            PersonalData::GOLDEN_LINE_URL
        );
        
        $this->tcpdf->Line(
            self::CONTACT_LINE_UP_CURSOR_X_START,
            self::CONTACT_LINE_UP_CURSOR_Y,
            self::CONTACT_LINE_UP_CURSOR_X_END,
            self::CONTACT_LINE_UP_CURSOR_Y
        );
        
        $this->tcpdf->Line(
            self::CONTACT_LINE_DOWN_CURSOR_X_START,
            self::CONTACT_LINE_DOWN_CURSOR_Y,
            self::CONTACT_LINE_DOWN_CURSOR_X_END,
            self::CONTACT_LINE_DOWN_CURSOR_Y
        );
    }
    
    /**
     * Renders personal photo in header
     */
    private function renderPersonalDataPhoto()
    {
        $x = 19;
        $y = 5;
        $width = 30;
        $height = 37;

        $this->tcpdf->renderImage('photo.png', $x, $y, $width, $height, PersonalData::EMAIL_URL);
        
        $this->tcpdf->SetDrawColor(150, 150, 150);
        $this->tcpdf->Rect($x, $y, $width, $height);
        
        $this->tcpdf->SetXY(17, 40.3);
        
        $this->tcpdf->SetTextColor(150, 150, 150);
        $this->tcpdf->SetFont($this->tcpdf->tahoma, 'B', 6);
        $this->tcpdf->Write(6, 'most recent version cv.creolink.pl', PdfConfig::DOCUMENT_URL);
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