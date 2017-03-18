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

class EmploymentCompanyName extends AbstractTcpdfDecorator
{
    const DATE_FONT_SIZE = 8;
    const DATE_CELL_WIDTH = 0;
    const DATE_CELL_HEIGHT = 6;

    const SEPARATOR_COMMA = ', ';
    const SEPARATOR_MINUS = ' - ';

    /**
     * @param EmploymentPosition $position
     * @param float $x
     * @param float $y
     */
    public function renderCompanyName(EmploymentPosition $position, float $x, float $y)
    {
        $this->configure();

        $this->tcpdf->SetXY($x, $y);

        $this->tcpdf->Cell(
            self::DATE_CELL_WIDTH,
            self::DATE_CELL_HEIGHT,
            $this->getCompany($position)
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
            $this->tcpdf->tahoma,
            Font::NORMAL,
            self::DATE_FONT_SIZE
        );
    }

    /**
     * @param EmploymentPosition $position
     * @return string
     */
    private function getCompany(EmploymentPosition $position): string
    {
        return $this->trans(
            $position->getCompany()
        );
    }
}
