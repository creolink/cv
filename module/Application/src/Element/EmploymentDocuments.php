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
use Application\Config\Image;

class EmploymentDocuments extends AbstractTcpdfDecorator
{
    const DOWNLOAD_ICON_MARGIN = 5.5;
    const DOWNLOAD_DOCUMENT_FONT_SIZE = 7;

    /**
     * Configures element
     */
    protected function configure()
    {
        $this->tcpdf->SetTextColor(
            Color::TEXT_COLOR_MEDIUM_RED,
            Color::TEXT_COLOR_MEDIUM_GREEN,
            Color::TEXT_COLOR_MEDIUM_BLUE
        );

        $this->tcpdf->SetFont(
            $this->tcpdf->tahoma,
            Font::NORMAL,
            self::DOWNLOAD_DOCUMENT_FONT_SIZE
        );
    }

    /**
     * Renders save image with proper link
     *
     * @param float $y
     * @param type $link
     */
    protected function renderDownloadIcon($y, $link = '')
    {
        $this->tcpdf->renderImage(
            Image::DOWNLOAD,
            $this->tcpdf->GetX(),
            $y + self::DOWNLOAD_ICON_MARGIN,
            Image::DOWNLOAD_WIDTH,
            Image::DOWNLOAD_HEIGHT,
            $link
        );
    }
}
