<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Decorator\AbstractTcpdfDecorator;
use Application\Entity\EmploymentPosition;
use Application\Config\Font;
use Application\Config\Color;

class EmploymentDescription extends AbstractTcpdfDecorator
{
    const SECTION_WIDTH = 197;

    const DESCRIPTION_MARGIN_X = 1.5;
    const DESCRIPTION_MARGIN_Y = 10;
    const DESCRIPTION_FONT_SIZE = 8;
    const DESCRIPTION_LINE_HEIGHT = 4;

    /**
     * @param EmploymentPosition $position
     * @param float $x
     * @param float $y
     */
    public function renderDescription(EmploymentPosition $position, $x, $y)
    {
        $this->configure();

        $this->tcpdf->SetXY(
            $x + self::DESCRIPTION_MARGIN_X,
            $y + self::DESCRIPTION_MARGIN_Y
        );

        $this->tcpdf->MultiCell(
            self::SECTION_WIDTH,
            self::DESCRIPTION_LINE_HEIGHT,
            $this->trans(
                $position->getDescription()
            )
            . self::NEW_LINE
        );
    }

    /**
     * Configures element
     */
    private function configure()
    {
        $this->tcpdf->SetFont(
            $this->tcpdf->tahoma,
            Font::NORMAL,
            self::DESCRIPTION_FONT_SIZE
        );

        $this->tcpdf->SetTextColor(
            Color::TEXT_COLOR_MEDIUM_RED,
            Color::TEXT_COLOR_MEDIUM_GREEN,
            Color::TEXT_COLOR_MEDIUM_BLUE
        );
    }
}
