<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Builder;

use Application\Model\TcpdfInterface;
use Application\Model\CurriculumVitae;
use Application\Config\Color;

abstract class AbstractPage
{
    const MARGIN_LEFT = 1;
    const MARGIN_TOP = 1;
    const MARGIN_RIGHT = 1;
    
    const CURSOR_X = 0;
    const CURSOR_Y = 0;
    
    const FONT_SIZE = 8;
    
    /**
     * @var TcpdfInterface|CurriculumVitae
     */
    protected $tcpdf;
    
    /**
     * @param TcpdfInterface $tcpdf
     */
    public function __construct(TcpdfInterface $tcpdf)
    {
        $this->tcpdf = $tcpdf;
    }
    
    /**
     * @return TcpdfInterface
     */
    public function createPage()
    {
        $this->tcpdf->AddPage();
        
        $this->setMargins();
        $this->setTextColor();
        $this->setFont();
        $this->setCursor();
        
        return $this->createElements(
            $this->tcpdf
        );
    }
    
    /**
     * @param TcpdfInterface $page
     * 
     * @return TcpdfInterface
     */
    abstract public function createElements(TcpdfInterface $page);
    
    /**
     * Sets default font for page
     */
    private function setFont()
    {
        $this->tcpdf->SetFont(
            $this->tcpdf->dejavu,
            '',
            self::FONT_SIZE
        );
    }
    
    /**
     * Sets default cursor position on page
     */
    private function setCursor()
    {
        $this->tcpdf->SetXY(
            self::CURSOR_X,
            self::CURSOR_Y
        );
    }
    
    /**
     * Sets default text color for page
     */
    private function setTextColor()
    {
        $this->tcpdf->SetTextColor(
            Color::TEXT_COLOR_DARK_RED,
            Color::TEXT_COLOR_DARK_GREEN,
            Color::TEXT_COLOR_DARK_BLUE
        );
    }
    
    /**
     * Sets default margins for page
     */
    private function setMargins()
    {
        $this->tcpdf->SetMargins(
            self::MARGIN_LEFT,
            self::MARGIN_TOP,
            self::MARGIN_RIGHT
        );
    }
}
