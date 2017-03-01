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
use Application\Config\PdfConfig;

class MainHeaderMostRecentInfo extends AbstractTcpdfDecorator
{
    const INFO_CURSOR_X = 17.3;
    const INFO_CURSOR_Y = 40.3;

    const INFO_FONT_SIZE = 6;

    /**
     * Renders information about most recent CV
     */
    public function renderMostRecentInfo()
    {
        $this->tcpdf->SetXY(
            self::INFO_CURSOR_X,
            self::INFO_CURSOR_Y
        );

        $this->tcpdf->SetTextColor(
            Color::TEXT_COLOR_LIGHT_RED,
            Color::TEXT_COLOR_LIGHT_GREEN,
            Color::TEXT_COLOR_LIGHT_BLUE
        );

        $this->tcpdf->SetFont(
            $this->tcpdf->tahoma,
            Font::BOLD,
            self::INFO_FONT_SIZE
        );

        $this->tcpdf->Write(
            self::INFO_FONT_SIZE,
            'most recent version cv.creolink.pl',
            PdfConfig::DOCUMENT_URL
        );
    }
}
