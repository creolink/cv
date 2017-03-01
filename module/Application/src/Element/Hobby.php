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

class Hobby extends AbstractSection
{
    const CURSOR_X = 5;
    const CURSOR_Y = 251;

    const SECTION_WIDTH = 65;

    const CELL_HEIGHT = 4;
    const CELL_PADDING = 1;

    const FONT_SIZE = 7;

    /**
     * {@inheritDoc}
     */
    public function addElements()
    {
        $this->tcpdf = $this->tcpdf->addElements();

        $this->setSolidLine();

        return $this->renderHobby();
    }

    /**
     * @return TcpdfInterface
     */
    private function renderHobby()
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
        return 'My free time I spend playing board games "Civilization Through the Ages" or "Robinson Crusoe: Adventure on the Cursed Island". '
            . 'I like to watch sf & adventure movies as well as tv series. My favourite are "Battlestar Galactica" & "The Last of the Mohicans". '
            . 'When I have possibility I play football or table tennis. '
            . 'I also like to analize Stock Exchange and our investments.'
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
        $sectionTitle->setTitle('Hobby & Sport');
        $sectionTitle->setWidth(self::SECTION_WIDTH);

        return $sectionTitle;
    }
}
