<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\AbstractSection;
use Application\Entity\SectionTitle;
use Application\Model\TcpdfInterface;

class Expectations extends AbstractSection
{
    const CURSOR_X = 5;
    const CURSOR_Y = 263;

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

        return $this->renderExpectations();
    }

    /**
     * @return TcpdfInterface
     */
    private function renderExpectations()
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
    private function getContent()
    {
        return $this->trans('cv-expectations-content')
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
            $this->trans('cv-expectations-sectionTitle')
        );
        $sectionTitle->setWidth(self::SECTION_WIDTH);

        return $sectionTitle;
    }
}
