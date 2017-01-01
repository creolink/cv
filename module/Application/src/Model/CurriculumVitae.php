<?php

namespace Application\Model;

use TCPDF;

class CurriculumVitae extends TCPDF
{
    public $isDownloaded = false;
    public $selectedLanguage = 'en';

    private $verdana = '';
    private $verdanaItalic = '';
    private $tahoma = '';
    private $tahomaBold = '';
    private $tahomaItalic = '';
    private $dejavu = '';
    private $cursorPositionX = 0;
    private $cursorPositionY = 0;
    private $workStartYear = 2001;
    private $documentAuthor = 'Jakub Luczynski';
    private $documentTitle = 'Jakub Luczynski, Curriculum Vitae';
    private $documentKeywords = 'Jakub Luczynski, CV, web developer, php, specialist, project manager';
    private $birthDate = '01/19/1979';
    
    private $nationality = 'Polish';
    private $country = 'Germany';
    private $street = 'Am Wall 54';
    private $city = 'Kleinmachnow';
    private $postCode = '14532';
    private $phone = '+49 1521 7786892';
    private $phoneUrl = 'tel:04915217786892';
    private $email = 'jakub.luczynski@gmail.com';
    private $emailUrl = 'mailto:jakub.luczynski@gmail.com';
    private $cvUrl = 'http://cv.creolink.pl';
    
	public function footer()
    {
        $text = "I hereby give consent for my personal data included in my offer to be processed for the purposes of recruitment, in accordance with the\r\nPersonal Data Protection Act dated 29.08.1997 (uniform text: Journal of Laws of the Republic of Poland 2002 No 101, item 926 with further amendments).";
        
        $this->SetXY(5, -15);
        $this->SetFont($this->verdana, '', 6);
        $this->SetTextColor(150, 150, 150);
        $this->MultiCell(200, 3, $text, 0, 'C', FALSE);
        $this->Cell(223, 4, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, 0, 'R');
	}
    
    public function header()
    {
        if ($this->getPage() > 1) {
            $this->SetTextColor(150, 150, 150);
            $this->SetDrawColor(150, 150, 150);
            
            $x = 62;
            $y = 6;
            
            $this->addPhoto($x, $y);
            

            
            $this->SetXY($x + 7, $y);
            $this->Write(4, $this->documentTitle);
            
            $x = $this->GetX();
            $this->renderIcon($x + 2, $y, 'images/phone.png', $this->phone, $this->phoneUrl, 1);
            $this->renderIcon($x + 30, $y, 'images/email.png', $this->email, $this->emailUrl, 1);
            $this->renderIcon($x + 67, $y, 'images/skype.png', 'luczynski.jakub', 'skype:luczynski.jakub', 1);
        }
    }
    
    private function addPhoto($x, $y)
    {
        $width = 5.5;
        $height = 7;
        
        $this->Image('images/photo.png', $x, $y - 1.5, $width, $height, 'PNG', $this->cvUrl);
        $this->Rect($x, $y - 1.5, $width, $height);
    }
    
    private function addPageNumber($y)
    {
        $this->SetY($y);
        $this->SetFont($this->verdana, '', 6);
        $this->Cell(223, 4, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, 0, 'R');
    }
    
    private function configure()
    {
        $this->Open();
        $this->SetCreator($this->documentAuthor . ', powered by TCPDF');
        $this->SetAuthor($this->documentAuthor);
        $this->SetTitle($this->documentTitle);
        $this->SetSubject($this->documentTitle);
        $this->SetKeywords($this->documentKeywords);
        $this->SetCompression(true);
        $this->SetDisplayMode('real');
        $this->SetAutoPageBreak(true, 10);
        $this->setFontSubsetting(true);
        $this->setPrintHeader(true);
        $this->setPrintFooter(true);
        
        $this->verdana = TCPDF_FONTS::addTTFfont('fonts/unifont/verdana.ttf', '', '', 32);
        $this->verdanaItalic = TCPDF_FONTS::addTTFfont('fonts/unifont/verdanai.ttf', '', '', 32);
        $this->tahoma = TCPDF_FONTS::addTTFfont('fonts/unifont/tahoma.ttf', '', '', 32);
        $this->tahomaBold = TCPDF_FONTS::addTTFfont('fonts/unifont/tahomabd.ttf', '', '', 32);
        $this->tahomaItalic = TCPDF_FONTS::addTTFfont('fonts/unifont/tahomai.ttf', '', '', 32);
        $this->dejavu = TCPDF_FONTS::addTTFfont('fonts/unifont/DejaVuSansCondensed.ttf', '', '', 32);
    }
}