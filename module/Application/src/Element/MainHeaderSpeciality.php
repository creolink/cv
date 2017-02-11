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

class MainHeaderSpeciality extends AbstractTcpdfDecorator implements MainHeaderTitleInterface
{
    const SPECIALITY_FONT_SIZE = 8;
    const SPECIALITY_PADDING_Y = 23;
    
    /**
     * Renders speciality
     */
    public function renderSpeciality()
    {
        $this->tcpdf->SetTextColor(
            Color::TEXT_COLOR_MEDIUM_RED,
            Color::TEXT_COLOR_MEDIUM_GREEN,
            Color::TEXT_COLOR_MEDIUM_BLUE
        );
        
        $this->tcpdf->SetFont(
            $this->tcpdf->tahoma,
            Font::NORMAL,
            self::SPECIALITY_FONT_SIZE
        );
        
        $this->tcpdf->SetXY(
            self::TITLE_CURSOR_X + self::TITLE_PADDING,
            self::TITLE_CURSOR_Y + self::SPECIALITY_PADDING_Y
        );
        
        $this->tcpdf->Cell(
            self::TITLE_CELL_WIDTH,
            self::TITLE_CELL_HEIGHT,
            mb_strtoupper(
                'WEB DEVELOPER, PHP SPECIALIST & PROJECT MANAGER',
                self::ENCODING
            ),
            self::BORDER_NONE,
            self::CELL_LINE_NONE,
            self::ALIGN_RIGHT
        );
    }
}
