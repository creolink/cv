<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\AbstractSection;
use Application\Entity\SectionTitle;
use Application\Config\Font;
use Application\Model\TcpdfInterface;

class Education extends AbstractSection
{
    const CURSOR_X = 72.5;
    const CURSOR_Y = 251;

    const SECTION_WIDTH = 65;

    const CELL_HEIGHT = 4;

    const FONT_SIZE = 7;

    /**
     * {@inheritDoc}
     */
    public function addElements(): TcpdfInterface
    {
        $this->tcpdf = $this->tcpdf->addElements();

        $this->setSolidLine();

        return $this->renderEducation();
    }

    /**
     * @return TcpdfInterface
     */
    private function renderEducation()
    {
        $this->renderTitle(
            $this->createSectionTitle()
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
            self::SECTION_WIDTH,
            self::CELL_HEIGHT,
            $this->getContent(),
            self::BORDER_NONE,
            self::ALIGN_LEFT
        );
    }

    /**
     * @return string
     */
    private function getContent()
    {
        return $this->trans('cv-education-content')
            . self::NEW_LINE;
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
            $this->trans('cv-education-sectionTitle')
        );
        $sectionTitle->setWidth(self::SECTION_WIDTH);

        return $sectionTitle;
    }
}
