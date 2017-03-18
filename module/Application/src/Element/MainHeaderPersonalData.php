<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Decorator\AbstractTcpdfDecorator;
use Application\Config\PersonalData;
use Application\Helper\DateHelper;
use Application\Config\Color;
use Application\Config\Font;
use \DateTime;

class MainHeaderPersonalData extends AbstractTcpdfDecorator
{
    const CURSOR_X = 152;
    const CURSOR_Y = 3.8;

    const LINE_WIDTH = 0.1;

    const FONT_SIZE = 8;

    const POSITION_MARGIN = 1.2;

    const DATA_BOX_STLE = 'DF';
    const DATA_BOX_BORDER_CORNERS = '1111';
    const DATA_BOX_WIDTH = 22;
    const DATA_BOX_HEIGHT = 4;
    const DATA_BOX_BORDER_RADIUS = 1;

    const DATA_BOX_TITLE_PADDING_Y = 1;
    const DATA_BOX_TITLE_PADDING_X = 0.4;
    const DATA_BOX_TITLE_WIDTH = 10;
    const DATA_BOX_TITLE_HEIGHT = 6;

    const DATA_TEXT_MARGIN_X = 12;
    const DATA_TEXT_MARGIN_Y = 0.2;
    const DATA_TEXT_WIDTH = 32;
    const DATA_TEXT_LINE_HEIGHT = 0;

    /**
     * Renders personal data
     */
    public function renderPersonalData()
    {
        $this->configure();

        $this->tcpdf->setXY(
            self::CURSOR_X,
            self::CURSOR_Y
        );

        foreach ($this->getSortedPositions() as $name => $text) {
            $this->renderPersonalDataRow(
                $this->trans($name),
                $text,
                $this->tcpdf->GetY() + self::POSITION_MARGIN
            );
        }
    }

    /**
     * @return array
     */
    private function getSortedPositions(): array
    {
        return [
            'cv-mainHeader-personalData-experience' => $this->createExperienceText(),
            'cv-mainHeader-personalData-birthDate' => $this->localizeDate(
                new DateTime(PersonalData::BIRTH_DATE)
            ),
            'cv-mainHeader-personalData-nationality' => $this->trans(PersonalData::NATIONALITY),
            'cv-mainHeader-personalData-address' => $this->createAddressText(),
            'cv-mainHeader-personalData-workplace' => $this->trans(PersonalData::WORK_PLACE),
        ];
    }

    /**
     * @return string
     */
    private function createExperienceText(): string
    {
        return sprintf(
            $this->trans('cv-mainHeader-personalData-years'),
            DateHelper::getPassedYears(
                PersonalData::WORK_START_YEAR
            )
        );
    }

    /**
     * @return string
     */
    private function createAddressText(): string
    {
        return PersonalData::STREET . self::NEW_LINE
            . PersonalData::POST_CODE . ' ' . PersonalData::CITY . self::NEW_LINE
            . $this->trans(PersonalData::COUNTRY);
    }

    /**
     * Configures the element
     */
    private function configure()
    {
        $this->tcpdf->SetFont(
            $this->tcpdf->dejavu,
            Font::NORMAL,
            self::FONT_SIZE
        );

        $this->tcpdf->SetTextColor(
            Color::TEXT_COLOR_DARK_RED,
            Color::TEXT_COLOR_DARK_GREEN,
            Color::TEXT_COLOR_DARK_BLUE
        );

        $this->tcpdf->SetFillColor(
            Color::FILL_COLOR_MEDIUM_RED,
            Color::FILL_COLOR_MEDIUM_GREEN,
            Color::FILL_COLOR_MEDIUM_BLUE
        );

        $this->tcpdf->SetLineWidth(
            self::LINE_WIDTH
        );
    }

    /**
     * @param string $name
     * @param string $text
     * @param float $y
     */
    private function renderPersonalDataRow(string $name, string $text, float $y)
    {
        $this->renderPersonalDataBox($y);
        $this->renderPersonalDataBoxTitle($name, $y);

        $this->renderPersonalDataText($text, $y);
    }

    /**
     * @param float $y
     */
    private function renderPersonalDataBox(float $y)
    {
        $this->tcpdf->RoundedRect(
            self::CURSOR_X,
            $y,
            self::DATA_BOX_WIDTH,
            self::DATA_BOX_HEIGHT,
            self::DATA_BOX_BORDER_RADIUS,
            self::DATA_BOX_BORDER_CORNERS,
            self::DATA_BOX_STLE
        );
    }

    /**
     * Renders box title
     *
     * @param string $name
     * @param float $y
     */
    private function renderPersonalDataBoxTitle(string $name, float $y)
    {
        $this->tcpdf->SetXY(
            self::CURSOR_X + self::DATA_BOX_TITLE_PADDING_X,
            $y - self::DATA_BOX_TITLE_PADDING_Y
        );

        $this->tcpdf->Cell(
            self::DATA_BOX_TITLE_WIDTH,
            self::DATA_BOX_TITLE_HEIGHT,
            $name
        );
    }

    /**
     * @param string $text
     * @param float $y
     */
    private function renderPersonalDataText(string $text, float $y)
    {
        $this->tcpdf->SetXY(
            $this->tcpdf->getX() + self::DATA_TEXT_MARGIN_X,
            $y + self::DATA_TEXT_MARGIN_Y
        );

        $this->tcpdf->MultiCell(
            self::DATA_TEXT_WIDTH,
            self::DATA_TEXT_LINE_HEIGHT,
            $text,
            self::BORDER_NONE,
            self::ALIGN_LEFT
        );
    }
}
