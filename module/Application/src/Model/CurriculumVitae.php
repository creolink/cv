<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Model;

use TCPDF;
use TCPDF_FONTS;
use Application\Decorator\PdfDocumentDecoratorInterface;
use Application\Decorator\PdfPageDecoratorInterface;

class CurriculumVitae extends TCPDF implements PdfDocumentDecoratorInterface, PdfPageDecoratorInterface
{
    public $isDownloaded = false;
    public $selectedLanguage = 'en';

    public $verdana = '';
    public $verdanaItalic = '';
    public $tahoma = '';
    public $tahomaBold = '';
    public $tahomaItalic = '';
    public $dejavu = '';
    
    public $cursorPositionX = 0;
    public $cursorPositionY = 0;
    
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
    private $fontsPath = 'public/fonts/unifont/';
    
    public function __construct($orientation = 'P', $unit = 'mm', $format = 'A4', $unicode = true, $encoding = 'UTF-8', $diskcache = false, $pdfa = false)
    {
        parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache, $pdfa);
        
        $this->configure();
        $this->initFonts();
    }
    
    /**
     * Adds header only for 2nd page and later
     * 
     * {@inheritDoc}
     */
    public function header()
    {
        if ($this->getPage() > 1) {
            $this->SetTextColor(150, 150, 150);
            $this->SetDrawColor(150, 150, 150);
            
            $x = 62;
            $y = 6;
            
            $this->renderPhotoInHeader($x, $y);
            
            $this->SetXY($x + 7, $y);
            $this->Write(4, $this->documentTitle);
            
            $x = $this->GetX();
//            $this->renderIcon($x + 2, $y, 'images/phone.png', $this->phone, $this->phoneUrl, 1);
//            $this->renderIcon($x + 30, $y, 'images/email.png', $this->email, $this->emailUrl, 1);
//            $this->renderIcon($x + 67, $y, 'images/skype.png', 'luczynski.jakub', 'skype:luczynski.jakub', 1);
        }
    }
    
    /**
     * Creates footer for all pages
     * 
     * {@inheritDoc}
     */
	public function footer()
    {
        $text = "I hereby give consent for my personal data included in my offer to be processed for the purposes of recruitment, in accordance with the\r\nPersonal Data Protection Act dated 29.08.1997 (uniform text: Journal of Laws of the Republic of Poland 2002 No 101, item 926 with further amendments).";
        
        $this->SetXY(5, -15);
        $this->SetFont($this->verdana, '', 6);
        $this->SetTextColor(150, 150, 150);
        $this->MultiCell(200, 3, $text, 0, 'C', FALSE);
        $this->Cell(223, 4, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, 0, 'R');
	}

    /**
     * Renders PDF document
     */
    public function renderPdf()
    {
        $this->Output();
    }
    
    /**
     * {@inheritDoc}
     */
    public function addElements()
    {
        return $this;
    }
    
    /**
     * {@inheritDoc}
     */
    public function createPage()
    {
        return $this;
    }

    /**
     * Configures PDF document parameters
     */
    private function configure()
    {
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
    }
    
    /**
     * Initialize used fonts
     */
    private function initFonts()
    {
        $this->verdana = $this->registerFont('verdana.ttf');
        $this->verdanaItalic = $this->registerFont('verdanai.ttf');
        $this->tahoma = $this->registerFont('tahoma.ttf');
        $this->tahomaBold = $this->registerFont('tahomabd.ttf');
        $this->tahomaItalic = $this->registerFont('tahomai.ttf');
        $this->dejavu = $this->registerFont('DejaVuSansCondensed.ttf');
    }
    
    /**
     * @param string $font
     * @return string
     */
    private function registerFont($font)
    {
        return TCPDF_FONTS::addTTFfont($this->fontsPath . $font, '', '', 32);
    }
    
    /**
     * Adds Page number for CV
     * 
     * @param float $y
     */
    private function addPageNumber($y)
    {
        $this->SetY($y);
        $this->SetFont($this->verdana, '', 6);
        $this->Cell(223, 4, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, 0, 'R');
    }
    
    /**
     * Adds my photo in selected position
     * 
     * @param float $x
     * @param float $y
     */
    private function renderPhotoInHeader($x, $y)
    {
        $width = 5.5;
        $height = 7;
        
        //$this->Image('images/photo.png', $x, $y - 1.5, $width, $height, 'PNG', $this->cvUrl);
        $this->Rect($x, $y - 1.5, $width, $height);
    }
}