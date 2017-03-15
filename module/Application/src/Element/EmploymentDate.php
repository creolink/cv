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

class EmploymentDate extends AbstractTcpdfDecorator
{
    const DATE_FONT_SIZE = 8;
    const DATE_CELL_WIDTH = 0;
    const DATE_CELL_HEIGHT = 6;
    const DATE_CELL_MARGIN = 1;

    const SEPARATOR_COMMA = ', ';
    const SEPARATOR_MINUS = ' - ';

    /**
     * @param EmploymentPosition $position
     * @param float $x
     * @param float $y
     */
    public function renderDate(EmploymentPosition $position, float $x, float $y)
    {
        $this->configure();

        $this->tcpdf->SetXY($x, $y);

        $this->tcpdf->Cell(
            self::DATE_CELL_WIDTH,
            self::DATE_CELL_HEIGHT,
            $this->getDate($position)
        );
    }

    /**
     * @param EmploymentPosition $position
     * @return float
     */
    public function getWidth(EmploymentPosition $position)
    {
        return $this->tcpdf->GetStringWidth(
            $this->getDate($position)
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
    private function getDate(EmploymentPosition $position)
    {
        return $this->getStartDate($position)
            . self::SEPARATOR_MINUS
            . $this->getFinishDate($position)
            . $this->getPartTime($position)
            . self::SEPARATOR_COMMA;
    }

    /**
     * @param EmploymentPosition $position
     * @return string
     */
    private function getStartDate(EmploymentPosition $position)
    {
        return $this->localizeMonthAndYear(
            $position->getDateStart()
        );
    }

    /**
     * @param EmploymentPosition $position
     * @return string
     */
    private function getFinishDate(EmploymentPosition $position)
    {
        $dateEnd = $position->getDateEnd();

        return false === empty($dateEnd)
            ? $this->localizeMonthAndYear(
                $position->getDateEnd()
            ) : $this->trans('cv-employment-date-present');
    }

    /**
     * @param EmploymentPosition $position
     * @return string
     */
    private function getPartTime(EmploymentPosition $position)
    {
        return $position->isPartTime()
            ? self::SEPARATOR_COMMA . $this->trans('cv-employment-date-partTime')
            : '';
    }
}
