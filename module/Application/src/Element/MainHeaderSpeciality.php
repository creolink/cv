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
     * @var float Width of the cell with generated content
     */
    private $width = 0;

    /**
     * Renders speciality
     */
    public function renderSpeciality()
    {
        $this->configure();

        $this->tcpdf->SetXY(
            $this->calculatePointX(),
            self::TITLE_CURSOR_Y + self::SPECIALITY_PADDING_Y
        );

        $this->tcpdf->Cell(
            $this->getWidth(),
            self::TITLE_CELL_HEIGHT,
            $this->getContent(),
            self::BORDER_NONE,
            self::CELL_LINE_NONE,
            self::ALIGN_RIGHT
        );
    }

    /**
     * Calculates width of cell
     *
     * @return float
     */
    public function getWidth()
    {
        if ($this->width > 0) {
            return $this->width;
        }

        $this->width = $this->tcpdf->GetStringWidth(
            $this->getContent()
        );

        return $this->width;
    }

    /**
     * Calculates start point of drawing the cell
     *
     * @return float
     */
    public function calculatePointX()
    {
        return self::TITLE_CURSOR_X + (self::TITLE_CELL_WIDTH - $this->getWidth()) / 2 + self::TITLE_PADDING;
    }

    /**
     * Configures element
     */
    private function configure()
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
    }

    /**
     * @return string
     */
    private function getContent()
    {
        return mb_strtoupper(
            $this->trans(
                'cv-mainHeader-speciality'
            ),
            self::ENCODING
        );
    }
}
