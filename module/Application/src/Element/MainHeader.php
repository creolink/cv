<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Decorator\AbstractPdfDocumentDecorator;
use Application\Helper\DateHelper;
use Application\Model\PersonalData;

class MainHeader extends AbstractPdfDocumentDecorator
{
    /**
     * {@inheritDoc}
     */
    public function addElements()
    {
        parent::addElements();
        
        return $this->renderMainHeader();
    }
    
    /**
     * Creates Main CV Header
     */
    private function renderMainHeader()
    {
        $this->tcpdf->SetXY(0, 0);

        $this->tcpdf->SetLineWidth(0.1);
        
        $this->tcpdf->SetFillColor(245,246,244);
        $this->tcpdf->Rect(0, 0, 210, 45, 'F');
        
        $this->tcpdf->SetTextColor(76, 76, 76);
        
        $this->tcpdf->SetFont($this->tcpdf->tahomaBold, '', 30);
        $this->tcpdf->Text(85, 5, 'JAKUB');
        
        $this->tcpdf->SetFont($this->tcpdf->tahomaBold, '', 30);
        $this->tcpdf->Text(72, 16, 'ŁUCZYŃSKI');
        
        $this->tcpdf->SetTextColor(138, 138, 138);
        $this->tcpdf->SetFont($this->tcpdf->tahoma, '', 8);
        $this->tcpdf->Text(66, 29, 'WEB DEVELOPER, PHP SPECIALIST & PROJECT MANAGER');
        
        $this->tcpdf->SetTextColor(180, 180, 180);
        $this->tcpdf->SetXY(113, 31);
        $this->tcpdf->SetFont($this->tcpdf->tahoma, 'B', 5.5);
        $this->tcpdf->Write(6, 'CV created with PHP & TCPDF', 'https://tcpdf.org/');
        
        $this->tcpdf->SetDrawColor(200, 200, 200);
        
        $this->tcpdf->Rect(11, 6, 5, 3);
        $this->tcpdf->renderImage('en.png', 11, 6, 5, 3, 'PNG', 'http://'.$_SERVER['SERVER_NAME'].'/?en');
        
        $this->tcpdf->Rect(11, 10, 5, 3);
        $this->tcpdf->renderImage('de.png', 11, 10, 5, 3, 'PNG', 'http://'.$_SERVER['SERVER_NAME'].'/?en');
        
        $this->tcpdf->Rect(11, 14, 5, 3);
        $this->tcpdf->renderImage('pl.png', 11, 14, 5, 3, 'PNG', 'http://'.$_SERVER['SERVER_NAME'].'/?pl');
        
        if (!$this->tcpdf->isDownloaded) {
            $this->tcpdf->renderImage('save.png', 12, 18, 3, 3, 'PNG', 'http://'.$_SERVER['SERVER_NAME'].'/?download&en'); 
        }

        $this->tcpdf->Line(0, 39, 210, 39);
        $this->tcpdf->Line(0, 45, 210, 45);
        
        $this->renderPersonalDataPhoto();
        
        $this->tcpdf->SetTextColor(50, 50, 50);
        $this->tcpdf->renderIcon(55, 40, 'phone.png', PersonalData::PHONE, PersonalData::PHONE_URL);
        $this->tcpdf->renderIcon(83, 40, 'email.png', PersonalData::EMAIL, PersonalData::EMAIL_URL);
        $this->tcpdf->renderIcon(120, 40, 'linkedin.png', '/jakubluczynski', 'http://pl.linkedin.com/in/jakubluczynski');
        $this->tcpdf->renderIcon(143, 40, 'skype.png', 'luczynski.jakub', 'skype:luczynski.jakub');
        $this->tcpdf->renderIcon(167, 40, 'goldenline.png', '/jakub-luczynski', 'http://www.goldenline.pl/jakub-luczynski/');
        
        $this->renderPersonalData();
        
        return $this->tcpdf;
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

        $this->tcpdf->renderImage('photo.png', $x, $y, $width, $height, 'PNG', PersonalData::EMAIL_URL);
        
        $this->tcpdf->SetDrawColor(150, 150, 150);
        $this->tcpdf->Rect($x, $y, $width, $height);
        
        $this->tcpdf->SetXY(20.7, 40);
        
        $this->tcpdf->SetTextColor(150, 150, 150);
        $this->tcpdf->SetFont($this->tcpdf->tahoma, 'B', 5.5);
        $this->tcpdf->Write(6, 'most recent on cv.creolink.pl', PersonalData::CV_URL);
    }
    
    /**
     * Renders personal data
     */
    private function renderPersonalData()
    {
        $dateHelper = new DateHelper(
            strtotime(PersonalData::BIRTH_DATE)
        );
        
        $posYText = 4;
        $posYBox = 5;
        
        $this->tcpdf->SetFont($this->tcpdf->dejavu, '', 8);
        $this->tcpdf->SetFillColor(235,235,235);
        
        $this->tcpdf->RoundedRect(152, $posYBox, 22, 4, 1, '1111', 'DF');
        $this->tcpdf->SetXY(152, $posYText);
        $this->tcpdf->Cell(10, 6, 'Experience', 0, 0, 'L', false);
        $this->tcpdf->SetXY(174, $posYText);
        $this->tcpdf->Cell(10, 6, $dateHelper->getPassedYears(PersonalData::WORK_START_YEAR) . ' years', 0, 0, 'L', false);

        $this->tcpdf->RoundedRect(152, $posYBox+=5, 22, 4, 1, '1111', 'DF');
        $this->tcpdf->SetXY(152, $posYText+=5);
        $this->tcpdf->Cell(10, 6, 'Date of birth', 0, 0, 'L', false);
        $this->tcpdf->SetXY(174, $posYText);
        $this->tcpdf->Cell(10, 6, $dateHelper->getDate(), 0, 0, 'L', false); //'19 January 1979'
        
        $this->tcpdf->RoundedRect(152, $posYBox+=5, 22, 4, 1, '1111', 'DF');
        $this->tcpdf->SetXY(152, $posYText+=5);
        $this->tcpdf->Cell(10, 6, 'Nationality', 0, 0, 'L', false);
        $this->tcpdf->SetXY(174, $posYText);
        $this->tcpdf->Cell(10, 6, PersonalData::NATIONALITY, 0, 0, 'L', false);
        
        $this->tcpdf->RoundedRect(152, $posYBox+=5, 22, 4, 1, '1111', 'DF');
        $this->tcpdf->SetXY(152, $posYText+=5);
        $this->tcpdf->Cell(10, 6, 'Location', 0, 0, 'L', false);
        $this->tcpdf->SetXY(174, $posYText);
        $this->tcpdf->Cell(10, 6, PersonalData::COUNTRY, 0, 0, 'L', false);
        
        $this->tcpdf->RoundedRect(152, $posYBox+=5, 22, 4, 1, '1111', 'DF');
        $this->tcpdf->SetXY(152, $posYText+=5);
        $this->tcpdf->Cell(10, 6, 'Address', 0, 0, 'L', false);
        $this->tcpdf->SetXY(174, $posYText+=1);
        $this->tcpdf->MultiCell(35, 5, PersonalData::STREET . "\n" . PersonalData::POST_CODE . ' ' . PersonalData::CITY , 0, 'L', false);
        
        $this->tcpdf->RoundedRect(152, $posYBox+=8, 22, 4, 1, '1111', 'DF');
        $this->tcpdf->SetXY(152, $posYText+=7);
        $this->tcpdf->Cell(10, 6, 'Workplace', 0, 0, 'L', false);
        $this->tcpdf->SetXY(174, $posYText);
        $this->tcpdf->Cell(10, 6, 'Berlin Area, Potsdam', 0, 0, 'L', false);
    }
}