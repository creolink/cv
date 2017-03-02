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
use Application\Entity\SectionTitle;
use Application\Config\Font;

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
    const CONTENT_CELL_WIDTH = 198;
    const CONTENT_MARGIN = 0;
    const CONTENT_FONT_SIZE = 7.5;

    /**
     * {@inheritDoc}
     */
    public function addElements()
    {
        $this->tcpdf = $this->tcpdf->addElements();

        $this->setSolidLine();

        return $this->renderCareerGoals();
    }

    /**
     * @return TcpdfInterface
     */
    private function renderCareerGoals()
    {
        $this->renderTitle(
            $this->createSectionTitle()
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
            'Dear Sir or Madam'
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
     * @return SectionTitle
     */
    private function createSectionTitle()
    {
        $sectionTitle = new SectionTitle();
        $sectionTitle->setCursorX(self::CURSOR_X);
        $sectionTitle->setCursorY(self::CURSOR_Y);
        $sectionTitle->setTitle(
            $this->trans('cv-careerGoals-sectionTitle')
        );
        $sectionTitle->setWidth(self::SECTION_WIDTH);

        return $sectionTitle;
    }

    /**
     * @return string
     */
    private function getContent()
    {
        return sprintf(
            $this->trans('cv-careerGoals-content'),
            $this->getWorkedYears()
        ) . self::NEW_LINE;
    }

    /**
     * @return int
     */
    private function getWorkedYears()
    {
        return DateHelper::getPassedYears(
            PersonalData::WORK_START_YEAR
        );
    }
}
