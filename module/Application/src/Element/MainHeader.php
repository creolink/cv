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

class MainHeader extends AbstractPageDecorator
{
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
        $this->renderName();
        $this->renderSpeciality();
        $this->renderCreationInfo();
        $this->renderFlags();
        $this->renderDownloadButton();
        $this->renderContactData();
        $this->renderPersonalDataPhoto();
        $this->renderPersonalData();
        
        return $this->tcpdf;
    }
    
    private function configure()
    {
        $this->tcpdf->SetXY(0, 0);
        $this->tcpdf->SetLineWidth(0.1);
    }
    
    private function renderBackground()
    {
        $this->tcpdf->SetFillColor(245,246,244);
        $this->tcpdf->Rect(0, 0, 210, 45, 'F');
    }
    
    private function renderName()
    {
        $this->tcpdf->SetTextColor(50, 50, 50);
        
        $this->tcpdf->SetFont($this->tcpdf->tahomaBold, '', 30);
        $this->tcpdf->Text(85, 5, 'JAKUB');
        $this->tcpdf->Text(72, 16, 'ŁUCZYŃSKI');
    }
    
    private function renderSpeciality()
    {
        $this->tcpdf->SetTextColor(90, 90, 90);
        $this->tcpdf->SetFont($this->tcpdf->tahoma, '', 8);
        
        $this->tcpdf->Text(66, 29, 'WEB DEVELOPER, PHP SPECIALIST & PROJECT MANAGER');
    }
    
    private function renderCreationInfo()
    {
        $this->tcpdf->SetTextColor(150, 150, 150);
        $this->tcpdf->SetXY(110, 31);
        $this->tcpdf->SetFont($this->tcpdf->tahoma, 'B', 5.5);
        $this->tcpdf->Write(6, 'created in PHP with ZF3 & TCPDF', PersonalData::GITHUB);
    }
    
    private function renderFlags()
    {
        $this->tcpdf->SetDrawColor(200, 200, 200);
        
        $this->tcpdf->Rect(11, 6, 5, 3);
        $this->tcpdf->renderImage('en.png', 11, 6, 5, 3, 'http://'.$_SERVER['SERVER_NAME'].'/?en');
        
        $this->tcpdf->Rect(11, 10, 5, 3);
        $this->tcpdf->renderImage('de.png', 11, 10, 5, 3, 'http://'.$_SERVER['SERVER_NAME'].'/?en');
        
        $this->tcpdf->Rect(11, 14, 5, 3);
        $this->tcpdf->renderImage('pl.png', 11, 14, 5, 3, 'http://'.$_SERVER['SERVER_NAME'].'/?pl');
    }
    
    private function renderDownloadButton()
    {
        if (false === $this->tcpdf->isDownloaded) {
            $this->tcpdf->renderImage(
                Image::DOWNLOAD,
                12,
                18,
                Image::DOWNLOAD_WIDTH,
                Image::DOWNLOAD_HEIGHT,
                'http://'.$_SERVER['SERVER_NAME'].'/?download&en'
            ); 
        }
    }
    
    private function renderContactData()
    {
        $this->tcpdf->SetTextColor(50, 50, 50);
        
        $this->tcpdf->renderIcon(58, 40, Image::PHONE, PersonalData::PHONE, PersonalData::PHONE_URL);
        $this->tcpdf->renderIcon(86, 40, Image::EMAIL, PersonalData::EMAIL, PersonalData::EMAIL_URL);
        $this->tcpdf->renderIcon(123, 40, Image::SKYPE, PersonalData::SKYPE, PersonalData::SKYPE_URL);
        $this->tcpdf->renderIcon(152, 40, Image::LINKED_IN, PersonalData::LINKED_IN, PersonalData::LINKED_IN_URL);
        $this->tcpdf->renderIcon(177, 40, Image::GOLDEN_LINE, PersonalData::GOLDEN_LINE, PersonalData::GOLDEN_LINE_URL);
        
        $this->tcpdf->Line(0, 39, 210, 39);
        $this->tcpdf->Line(0, 45, 210, 45);
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