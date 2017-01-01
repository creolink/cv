<?php

namespace Application\Model;

use TCPDF;

class MainHeader
{
    /**
     * @var TCPDF $tcpdf 
     */
    private $tcpdf;
    
    /**
     * @param TCPDF $tcpdf
     */
    public function __construct(TCPDF $tcpdf) {
        $this->tcpdf = $tcpdf;
    }
    
    public function renderMainHeader()
    {
        $this->SetXY(0, 0);

        $this->SetLineWidth(0.1);
        
        $this->SetFillColor(245,246,244);
        $this->Rect(0, 0, 210, 45, 'F');
        
        $this->SetTextColor(76, 76, 76);
        
        $this->SetFont($this->tahomaBold, '', 30);
        $this->Text(85, 5, 'JAKUB');
        
        $this->SetFont($this->tahomaBold, '', 30);
        $this->Text(72, 16, 'ŁUCZYŃSKI');
        
        $this->SetTextColor(138, 138, 138);
        $this->SetFont($this->tahoma, '', 8);
        $this->Text(66, 29, 'WEB DEVELOPER, PHP SPECIALIST & PROJECT MANAGER');
        
        $this->SetTextColor(180, 180, 180);
        $this->SetXY(113, 31);
        $this->SetFont($this->tahoma, 'B', 5.5);
        $this->Write(6, 'CV created with PHP & TCPDF', 'https://tcpdf.org/');
        
        $this->SetDrawColor(200, 200, 200);
        
        $this->Rect(11, 6, 5, 3);
        $this->Image('images/en.png', 11, 6, 5, 3, 'PNG', 'http://'.$_SERVER['SERVER_NAME'].'/?en');
        
        $this->Rect(11, 10, 5, 3);
        $this->Image('images/de.png', 11, 10, 5, 3, 'PNG', 'http://'.$_SERVER['SERVER_NAME'].'/?en');
        
        $this->Rect(11, 14, 5, 3);
        $this->Image('images/pl.png', 11, 14, 5, 3, 'PNG', 'http://'.$_SERVER['SERVER_NAME'].'/?pl');
        
        if (!$this->isDownloaded) {
            $this->Image('images/save.png', 12, 18, 3, 3, 'PNG', 'http://'.$_SERVER['SERVER_NAME'].'/?download&en'); 
        }

        $this->Line(0, 39, 210, 39);
        $this->Line(0, 45, 210, 45);
        
        $this->renderPersonalDataPhoto();
        
        $this->SetTextColor(50, 50, 50);
        $this->renderIcon(55, 40, 'images/phone.png', $this->phone, $this->phoneUrl);
        $this->renderIcon(83, 40, 'images/email.png', $this->email, $this->emailUrl);
        $this->renderIcon(120, 40, 'images/linkedin.png', '/jakubluczynski', 'http://pl.linkedin.com/in/jakubluczynski');
        $this->renderIcon(143, 40, 'images/skype.png', 'luczynski.jakub', 'skype:luczynski.jakub');
        $this->renderIcon(167, 40, 'images/goldenline.png', '/jakub-luczynski', 'http://www.goldenline.pl/jakub-luczynski/');
        
        $this->renderPersonalData();
    }
}