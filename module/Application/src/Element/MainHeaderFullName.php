<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Decorator\AbstractTcpdfDecorator;
use Application\Config\PersonalData;
use Application\Config\Color;
use Application\Config\Font;

class MainHeaderFullName extends AbstractTcpdfDecorator implements MainHeaderTitle
{
    const FULL_NAME_FONT_SIZE = 30;
    
    const LASTNAME_PADDING = 11;
    
    /**
     * Renders CV title
     */
    public function renderTitle()
    {
        $this->configureTitle();
        
        $this->renderName();
        
        $this->renderLastname();
    }
    
    /**
     * Configures CV title
     */
    private function configureTitle()
    {
        $this->tcpdf->SetTextColor(
            Color::TEXT_COLOR_DARK_RED,
            Color::TEXT_COLOR_DARK_GREEN,
            Color::TEXT_COLOR_DARK_BLUE
        );
        
        $this->tcpdf->SetFont(
            $this->tcpdf->tahomaBold,
            Font::NORMAL,
            self::FULL_NAME_FONT_SIZE
        );
    }
    
    /**
     * Renders name
     */
    private function renderName()
    {
        $this->tcpdf->SetXY(
            self::TITLE_CURSOR_X,
            self::TITLE_CURSOR_Y
        );

        $this->tcpdf->Cell(
            self::TITLE_CELL_WIDTH,
            self::TITLE_CELL_HEIGHT,
            mb_strtoupper(
                PersonalData::NAME,
                self::ENCODING
            ),
            self::BORDER_NONE,
            self::CELL_LINE_NONE,
            self::ALIGN_CENTER
        );
    }
    
    /**
     * Renders lastname
     */
    private function renderLastname()
    {
        $this->tcpdf->SetXY(
            self::TITLE_CURSOR_X,
            self::TITLE_CURSOR_Y + self::LASTNAME_PADDING
        );
        
        $this->tcpdf->Cell(
            self::TITLE_CELL_WIDTH,
            self::TITLE_CELL_HEIGHT,
            mb_strtoupper(
                PersonalData::LASTNAME,
                self::ENCODING
            ),
            self::BORDER_NONE,
            self::CELL_LINE_NONE,
            self::ALIGN_CENTER
        );
    }
}
