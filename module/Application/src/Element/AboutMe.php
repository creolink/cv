<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\AbstractSection;
use Application\Config\PersonalData;
use Application\Config\Font;
use Application\Model\TcpdfInterface;

class AboutMe extends AbstractSection
{
    const CURSOR_X = 140;
    const CURSOR_Y = 251;

    const SECTION_WIDTH = 65;

    const CELL_HEIGHT = 4;
    const CELL_PADDING = 1;

    const FONT_SIZE = 7;

    /**
     * {@inheritDoc}
     */
    public function addElements(): TcpdfInterface
    {
        $this->tcpdf = $this->tcpdf->addElements();

        $this->setSolidLine();

        return $this->renderAboutMe();
    }

    /**
     * @return TcpdfInterface
     */
    private function renderAboutMe(): TcpdfInterface
    {
        $this->renderTitle(
            $this->createSection('cv-aboutMe-sectionTitle')
        );

        $this->renderContent();

        return $this->tcpdf;
    }

    /**
     * Renders content of element
     */
    private function renderContent()
    {
        $this->tcpdf->SetFont(
            $this->tcpdf->tahoma,
            Font::NORMAL,
            self::FONT_SIZE
        );

        $this->tcpdf->MultiCell(
            self::SECTION_WIDTH - self::CELL_PADDING,
            self::CELL_HEIGHT,
            $this->getContent(),
            self::BORDER_NONE,
            self::ALIGN_LEFT
        );
    }

    /**
     * @return string
     */
    private function getContent(): string
    {
        return sprintf(
            $this->trans(
                'cv-aboutMe-content'
            ),
            $this->getMaximusAge(),
            $this->getNoSmokingYears()
        ) . self::NEW_LINE;
    }

    /**
     * @return int
     */
    private function getMaximusAge(): int
    {
        return date("Y") - PersonalData::MAXIMUS_BIRTH_DATE;
    }

    /**
     * @return int
     */
    private function getNoSmokingYears(): int
    {
        return date("Y") - PersonalData::STOP_SMOKING_YEAR;
    }
}
