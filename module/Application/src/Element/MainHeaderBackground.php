<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Decorator\AbstractTcpdfDecorator;
use Application\Config\Color;

class MainHeaderBackground extends AbstractTcpdfDecorator
{
    const BACKGROUND_CURSOR_X = 0;
    const BACKGROUND_CURSOR_Y = 0;
    
    const BACKGROUND_WIDTH = 210;
    const BACKGROUND_HEIGHT = 45;
    const BACKGROUND_STYLE = 'F';
    
    /**
     * Renders header background
     */
    public function renderBackground()
    {
        $this->tcpdf->SetFillColor(
            Color::FILL_COLOR_BRIGHT_RED,
            Color::FILL_COLOR_BRIGHT_GREEN,
            Color::FILL_COLOR_BRIGHT_BLUE
        );
        
        $this->tcpdf->Rect(
            self::BACKGROUND_CURSOR_X,
            self::BACKGROUND_CURSOR_Y,
            self::BACKGROUND_WIDTH,
            self::BACKGROUND_HEIGHT,
            self::BACKGROUND_STYLE
        );
    }
}
