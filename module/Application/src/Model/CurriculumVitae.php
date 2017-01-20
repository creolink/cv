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
use Application\Model\PdfConfig;
use Application\Model\PersonalData;

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

    public function __construct($orientation = 'P', $unit = 'mm', $format = 'A4', $unicode = true, $encoding = 'UTF-8', $diskcache = false, $pdfa = false)
    {
        parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache, $pdfa);
        
        $this->configure();
        $this->initFonts();
    }
    
    /**
     * Overwrites default header and adds header only for 2nd page and later
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
            $this->Write(4, PdfConfig::DOCUMENT_TITLE);
            
            $x = $this->GetX();
            $this->renderIcon($x + 2, $y, 'phone.png', PersonalData::PHONE, PersonalData::PHONE_URL, 1);
            $this->renderIcon($x + 30, $y, 'email.png', PersonalData::EMAIL, PersonalData::EMAIL_URL, 1);
            $this->renderIcon($x + 67, $y, 'skype.png', 'luczynski.jakub', 'skype:luczynski.jakub', 1);
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
     * Renders image icon
     * 
     * @param float $x
     * @param float $y
     * @param string $image
     * @param string $text
     * @param string $url
     * @param float $move
     */
    public function renderIcon($x, $y, $image, $text, $url, $move = 0)
    {
        $this->SetFont('verdana', '', 6);
        
        $this->Image(PdfConfig::PATH_IMAGES . $image, $x, $y, 4, 4, 'PNG');
        $this->SetXY($x + 4 + $move, $y - 1);
        $this->Cell(10, 6, $text, 0, 0, 'L', false, $url);
    }
    
    /**
     * {@inheritDoc}
     */
    public function renderImage($file, $x, $y, $w, $h, $type, $link)
    {
        return $this->Image(
            PdfConfig::PATH_IMAGES . $file,
            $x,
            $y,
            $w,
            $h,
            $type,
            $link
        );
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
        return $this->createPage();
    }
    
    /**
     * {@inheritDoc}
     */
    public function createPage()
    {
        return $this-renderPdf();
    }

    /**
     * Configures PDF document parameters
     */
    private function configure()
    {
        $this->SetCreator(PdfConfig::DOCUMENT_AUTHOR . ', powered by TCPDF');
        $this->SetAuthor(PdfConfig::DOCUMENT_AUTHOR);
        $this->SetTitle(PdfConfig::DOCUMENT_TITLE);
        $this->SetSubject(PdfConfig::DOCUMENT_TITLE);
        $this->SetKeywords(PdfConfig::DOCUMENT_KEYWORDS);
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
        return TCPDF_FONTS::addTTFfont(PdfConfig::PATH_FONTS . $font, '', '', 32);
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
        
        $this->Image(PdfConfig::PATH_IMAGES . 'photo.png', $x, $y - 1.5, $width, $height, 'PNG', $this->cvUrl);
        $this->Rect($x, $y - 1.5, $width, $height);
    }
}
