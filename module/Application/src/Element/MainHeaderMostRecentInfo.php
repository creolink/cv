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
    /**
     * Renders information about most recent CV
     */
    public function renderMostRecentInfo()
    {
        $this->tcpdf->SetXY(
            17,
            40.3
        );
        
        $this->tcpdf->SetTextColor(
            Color::TEXT_COLOR_LIGHT_RED,
            Color::TEXT_COLOR_LIGHT_GREEN,
            Color::TEXT_COLOR_LIGHT_BLUE
        );
        
        $this->tcpdf->SetFont(
            $this->tcpdf->tahoma,
            Font::BOLD,
            6
        );
        
        $this->tcpdf->Write(
            6,
            'most recent version cv.creolink.pl',
            PdfConfig::DOCUMENT_URL
        );
    }
}
