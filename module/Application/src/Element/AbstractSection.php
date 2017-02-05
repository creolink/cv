<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Decorator\AbstractPageDecorator;
use Application\Config\Color;
use Application\Config\Font;
use Application\Entity\SectionTitle;
use Application\Hydrator\Hydrator;

abstract class AbstractSection extends AbstractPageDecorator
{
    const DEFAULT_WIDTH = 65;
    const FONT_SIZE = 13;
    const TITLE_MARGIN = 0;
    const CELL_HEIGHT = 6;
    const CELL_WIDTH = 0;
    const LINE_MARGIN = 6.2;
    const CURSOR_MARGIN_Y = 7;
    
    /**
     * Renders section title
     * 
     * @param SectionTitle $sectionTitle
     */
    protected function renderTitle(SectionTitle $sectionTitle)
    {
        $this->setColors();
        $this->setFont();
        $this->printTitle($sectionTitle);
        $this->drawLineUnderTitle($sectionTitle);
        $this->setCursor($sectionTitle);
    }
    
    /**
     * Sets colors for title
     */
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
     * Sets font for title
     */
    private function setFont()
    {
        $this->tcpdf->SetFont(
            $this->tcpdf->dejavu,
            Font::BOLD,
            self::FONT_SIZE
        );
    }
    
    /**
     * @param SectionTitle $sectionTitle
     */
    private function printTitle(SectionTitle $sectionTitle)
    {
        $this->tcpdf->SetXY(
            $sectionTitle->getCursorX() + self::TITLE_MARGIN,
            $sectionTitle->getCursorY()
        );
        
        $this->tcpdf->Cell(
            self::CELL_WIDTH,
            self::CELL_HEIGHT,
            $sectionTitle->getTitle()
        );
    }
    
    /**
     * @param SectionTitle $sectionTitle
     */
    private function drawLineUnderTitle(SectionTitle $sectionTitle)
    {
        $this->tcpdf->Line(
            $sectionTitle->getCursorX(),
            $sectionTitle->getCursorY() + self::LINE_MARGIN,
            $sectionTitle->getCursorX() + $sectionTitle->getWidth(),
            $sectionTitle->getCursorY() + self::LINE_MARGIN
        );
    }
    
    /**
     * @param SectionTitle $sectionTitle
     */
    private function setCursor(SectionTitle $sectionTitle)
    {
        $this->tcpdf->cursorPositionX = $sectionTitle->getCursorX();
        $this->tcpdf->cursorPositionY = $sectionTitle->getCursorY() + 6;
        
        $this->tcpdf->SetXY(
            $sectionTitle->getCursorX(),
            $sectionTitle->getCursorY() + self::CURSOR_MARGIN_Y
        );
    }
}
