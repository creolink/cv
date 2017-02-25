<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Model;

use TCPDF_FONTS;
use Application\Fixes\TcpdfFix;
use Application\Config\PdfConfig;
use Application\Config\Image;
use Application\Config\PersonalData;
use Application\Model\TcpdfInterface;
use Application\Normalization\NormalizedTranslationService;

class CurriculumVitae extends TcpdfFix implements TcpdfInterface
{
    public $isDownloaded = false;
    public $selectedLanguage = 'en';

    public $verdana = '';
    public $verdanaItalic = '';
    public $tahoma = '';
    public $tahomaBold = '';
    public $tahomaItalic = '';
    public $dejavu = '';
    
    /**
     * @var NormalizedTranslationService
     */
    private $translator;

    /**
     * {@inheritDoc}
     */
    public function addElements()
    {
        return $this;
    }
    
    /**
     * Injects translator service with normalization
     * 
     * @param NormalizedTranslationService $translator
     */
    public function setTranslator(NormalizedTranslationService $translator)
    {
        $this->translator = $translator;
    }
    
    /**
     * @return NormalizedTranslationService
     */
    public function getTranslator()
    {
        return $this->translator;
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
            
            $x = 5;
            $y = 6;
            
            $this->renderHeaderPhoto($x, $y - 1);
            
            $this->SetXY($x + 6, $y);
            $this->SetFont($this->verdana, '', 6);
            $this->Write(4, PdfConfig::DOCUMENT_TITLE);
            
            $x = $this->GetX();
            $this->renderIcon($this->GetX() + 2, $y, Image::PHONE, PersonalData::PHONE, PersonalData::PHONE_URL, 1);
            $this->renderIcon($this->GetX() + 13, $y, Image::EMAIL, PersonalData::EMAIL, PersonalData::EMAIL_URL, 1);
            $this->renderIcon($this->GetX() + 22, $y, Image::SKYPE, PersonalData::SKYPE, PersonalData::SKYPE_URL, 1);
            
            $this->addPageNumber($y);
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
        
        $y = -15;
        
        $this->SetXY(5, $y);
        $this->SetFont($this->verdana, '', 6);
        $this->SetTextColor(150, 150, 150);
        $this->MultiCell(200, 3, $text, 0, 'C', FALSE);
        
        $this->addPageNumber($y);
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
        $this->SetFont($this->verdana, '', 6);
        
        $this->Image(PdfConfig::PATH_IMAGES . $image, $x, $y, 4, 4, 'PNG');
        
        $this->SetXY($x + 4 + $move, $y - 1);
        $this->Cell(10, 6, $text, 0, 0, 'L', false, $url);
    }
    
    /**
     * {@inheritDoc}
     */
    public function renderImage($file, $x, $y, $w, $h, $link = '')
    {
        return $this->Image(
            PdfConfig::PATH_IMAGES . $file,
            $x,
            $y,
            $w,
            $h,
            '',
            $link
        );
    }

    /**
     * Renders PDF document inline or as downloadable attachement
     * 
     * @return string
     */
    public function renderPdf()
    {
        $this->Output(PdfConfig::FILE_NAME);
    }
    
    /**
     * Configures PDF document parameters
     */
    public function configure()
    {
        $this->Open();
        $this->SetCreator(PdfConfig::DOCUMENT_CREATOR);
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
    public function initFonts()
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
        
        $this->Cell(214.5, 4, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, 0, 'R');
    }
    
    /**
     * Adds my photo in selected position
     * 
     * @param float $x
     * @param float $y
     */
    private function renderHeaderPhoto($x, $y)
    {
        $width = 4.5;
        $height = 5.5;
        
        $this->Image(PdfConfig::PATH_IMAGES . Image::PERSONAL_PHOTO, $x, $y, $width, $height, 'PNG', PdfConfig::DOCUMENT_URL);
        $this->Rect($x, $y, $width, $height);
    }
}
