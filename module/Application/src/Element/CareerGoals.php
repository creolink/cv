<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\AbstractSection;
use Application\Helper\DateHelper;
use Application\Config\PersonalData;
use Application\Config\Font;
use Application\Model\TcpdfInterface;

class CareerGoals extends AbstractSection
{
    const CURSOR_X = 5;
    const CURSOR_Y = 47;

    const SECTION_WIDTH = 200;
    const SECTION_PADDING = 1;

    const RECIPIENT_CELL_HEIGHT = 5;
    const RECIPIENT_CELL_WIDTH = 198;
    const RECIPIENT_FONT_SIZE = 9;

    const CONTENT_CELL_HEIGHT = 4;
    const CONTENT_CELL_WIDTH = 199;
    const CONTENT_MARGIN = 0;
    const CONTENT_FONT_SIZE = 7.5;

    /**
     * {@inheritDoc}
     */
    public function addElements(): TcpdfInterface
    {
        $this->tcpdf = $this->tcpdf->addElements();

        $this->setSolidLine();

        return $this->renderCareerGoals();
    }

    /**
     * @return TcpdfInterface
     */
    private function renderCareerGoals(): TcpdfInterface
    {
        $this->renderTitle(
            $this->createSection('cv-careerGoals-sectionTitle')
        );

        $this->renderRecipient();
        $this->renderContent();

        return $this->tcpdf;
    }

    /**
     * Renders recipient name
     */
    private function renderRecipient()
    {
        $this->tcpdf->SetFont(
            $this->tcpdf->verdanaItalic,
            Font::ITALICT,
            self::RECIPIENT_FONT_SIZE
        );

        $this->tcpdf->SetXY(
            self::CURSOR_X + self::SECTION_PADDING,
            $this->tcpdf->GetY()
        );

        $this->tcpdf->Cell(
            self::RECIPIENT_CELL_WIDTH,
            self::RECIPIENT_CELL_HEIGHT,
            $this->trans('cv-careerGoals-recipent')
        );

        $this->tcpdf->Ln();
    }

    /**
     * Renders content of career goals
     */
    private function renderContent()
    {
        $this->tcpdf->SetFont(
            $this->tcpdf->verdanaItalic,
            Font::ITALICT,
            self::CONTENT_FONT_SIZE
        );

        $this->tcpdf->SetXY(
            self::CURSOR_X + self::SECTION_PADDING,
            $this->tcpdf->GetY() + self::CONTENT_MARGIN
        );

        $this->tcpdf->MultiCell(
            self::CONTENT_CELL_WIDTH,
            self::CONTENT_CELL_HEIGHT,
            $this->getContent()
        );
    }

    /**
     * @return string
     */
    private function getContent(): string
    {
        return sprintf(
            $this->trans('cv-careerGoals-content'),
            $this->getWorkedYears()
        ) . self::NEW_LINE;
    }

    /**
     * @return int
     */
    private function getWorkedYears(): int
    {
        return DateHelper::getPassedYears(
            PersonalData::WORK_START_YEAR
        );
    }
}
