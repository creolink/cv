<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Decorator\AbstractTcpdfDecorator;
use Application\Entity\EmploymentPosition;
use Application\Config\Color;
use Application\Config\Font;

class EmploymentPositionName extends AbstractTcpdfDecorator
{
    const NAME_MARGIN = 4.2;
    const NAME_FONT_SIZE = 9;
    const NAME_CELL_WIDTH = 150;
    const NAME_CELL_HEIGHT = 6;

    /**
     * @param EmploymentPosition $position
     * @param float $x
     * @param float $y
     */
    public function renderPositionName(EmploymentPosition $position, float $x, float $y)
    {
        $this->configure();

        $this->tcpdf->SetXY(
            $x,
            $y + self::NAME_MARGIN
        );

        $this->tcpdf->Cell(
            self::NAME_CELL_WIDTH,
            self::NAME_CELL_HEIGHT,
            $this->trans(
                $position->getName()
            )
        );
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
            $this->tcpdf->dejavu,
            Font::BOLD,
            self::NAME_FONT_SIZE
        );
    }
}
