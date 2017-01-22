<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Decorator\AbstractTcpdfDecorator;
use Application\Config\Color;
use Application\Config\Font;

abstract class AbstractBlockTitle extends AbstractTcpdfDecorator
{
    const DEFAULT_WIDTH = 65;
    const FONT_SIZE = 13;
    const TITLE_MARGIN = 0.6;
    const CELL_HEIGHT = 6;
    const CELL_WIDTH = 0;
    const LINE_WIDTH = 0.2;
    
    protected function renderBlockTitle($title, $x, $y, $width = self::DEFAULT_WIDTH)
    {
        $this->setColors();
        $this->printTitle($x, $y, $title);
        $this->drawLine($x, $y, $width);
        $this->setCursor($x);
    }
    
    private function setColors()
    {
        $this->tcpdf->SetDrawColor(
            Color::DRAW_COLOR_DARK_RED,
            Color::DRAW_COLOR_DARK_GREEN,
            Color::DRAW_COLOR_DARK_BLUE
        );
        
        $this->tcpdf->SetFillColor(
            Color::FILL_COLOR_BRIGHT_RED,
            Color::FILL_COLOR_BRIGHT_GREEN,
            Color::FILL_COLOR_BRIGHT_BLUE
        );
        
        $this->tcpdf->SetTextColor(
            Color::TEXT_COLOR_MEDIUM_RED,
            Color::TEXT_COLOR_MEDIUM_GREEN,
            Color::TEXT_COLOR_MEDIUM_BLUE
        );
    }
    
    /**
     * @param float $x
     * @param float $y
     * @param string $title
     */
    private function printTitle($x, $y, $title)
    {
        $this->tcpdf->SetFont($this->tcpdf->dejavu, Font::BOLD, self::FONT_SIZE);
        $this->tcpdf->SetXY($x + self::TITLE_MARGIN, $y);
        $this->tcpdf->Cell(self::CELL_WIDTH, self::CELL_HEIGHT, $title);
    }
    
    /**
     * @param float $x
     * @param float $y
     * @param float $width
     */
    private function drawLine($x, $y, $width)
    {
//        $this->tcpdf->SetLineStyle(
//                array('width' => self::LINE_WIDTH, 'dash' => '0')
//            );
        
        $this->tcpdf->Line($x, $y + 6, $x + $width, $y + 6);
    }
    
    /**
     * @param float $x
     */
    private function setCursor($x)
    {
        $this->tcpdf->cursorPositionX = $x + 1;
        $this->tcpdf->cursorPositionY = $this->tcpdf->GetY() + 6;
    }
}
