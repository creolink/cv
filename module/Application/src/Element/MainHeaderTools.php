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

class MainHeaderTools extends AbstractTcpdfDecorator implements MainHeaderTitleInterface
{
    const TOOLS_PADDING = 27;
    const TOOLS_FONT_SIZE = 6;

    /**
     * Renders infromation about used tools to create CV
     */
    public function renderTools()
    {
        $this->configure();

        $this->tcpdf->SetXY(
            self::TITLE_CURSOR_X + self::TITLE_PADDING,
            self::TITLE_CURSOR_Y + self::TOOLS_PADDING
        );

        $this->tcpdf->Cell(
            self::TITLE_CELL_WIDTH,
            self::TITLE_CELL_HEIGHT,
            $this->trans('cv-mainHeader-tools'),
            self::BORDER_NONE,
            self::CELL_LINE_NONE,
            self::ALIGN_RIGHT,
            self::TRANSPARENT,
            PersonalData::GITHUB
        );
    }

    /**
     * Configures element
     */
    private function configure()
    {
        $this->tcpdf->SetTextColor(
            Color::TEXT_COLOR_LIGHT_RED,
            Color::TEXT_COLOR_LIGHT_GREEN,
            Color::TEXT_COLOR_LIGHT_BLUE
        );

        $this->tcpdf->SetFont(
            $this->tcpdf->tahoma,
            Font::NORMAL,
            self::TOOLS_FONT_SIZE
        );
    }
}
