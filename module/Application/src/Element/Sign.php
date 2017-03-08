<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Decorator\AbstractPageDecorator;
use Application\Config\Image;
use Application\Config\Color;
use Application\Config\Font;

class Sign extends AbstractPageDecorator
{
    const CURSOR_X = 45;
    const CURSOR_Y = 260;

    const FONT_SIZE = 7;

    const SIGNATURE_LINE_WIDTH = 125;
    const SIGNATURE_MARGIN_Y = -5;
    const SIGNATURE_MARGIN_X = 15;

    const CAPTION_MARGIN_X = 4.5;
    const CAPTION_MARGIN_Y = -7;
    const CAPTION_WIDTH = 120;
    const CAPTION_LINE_HEIGHT = 4;

    /**
     * {@inheritDoc}
     */
    public function addElements()
    {
        $this->tcpdf = $this->tcpdf->addElements();

        $this->setSolidLine();

        return $this->renderSign();
    }

    /**
     * @return TcpdfInterface
     */
    private function renderSign()
    {
        $this->configure();

        $this->renderCaption();

        $this->renderSignature();

        return $this->tcpdf;
    }

    /**
     * Configures the element
     */
    private function configure()
    {
        $this->tcpdf->SetDrawColor(
            Color::DRAW_COLOR_BRIGHT_RED,
            Color::DRAW_COLOR_BRIGHT_GREEN,
            Color::DRAW_COLOR_BRIGHT_BLUE
        );

        $this->setSolidLine();

        $this->tcpdf->SetTextColor(
            Color::TEXT_COLOR_MEDIUM_RED,
            Color::TEXT_COLOR_MEDIUM_GREEN,
            Color::TEXT_COLOR_MEDIUM_BLUE
        );

        $this->tcpdf->SetFont(
            $this->tcpdf->verdanaItalic,
            Font::ITALICT,
            self::FONT_SIZE
        );
    }

    private function renderCaption()
    {
        $this->tcpdf->SetXY(
            self::CURSOR_X + self::CAPTION_MARGIN_X,
            self::CURSOR_Y + self::CAPTION_MARGIN_Y
        );

        $this->tcpdf->MultiCell(
            self::CAPTION_WIDTH,
            self::CAPTION_LINE_HEIGHT,
            $this->getContent(),
            self::BORDER_NONE,
            self::ALIGN_LEFT
        );
    }

    private function renderSignature()
    {
        $this->tcpdf->Line(
            self::CURSOR_X,
            self::CURSOR_Y,
            self::CURSOR_X + self::SIGNATURE_LINE_WIDTH,
            self::CURSOR_Y
        );

        $this->tcpdf->renderImage(
            Image::SIGN,
            self::CURSOR_X + self::SIGNATURE_MARGIN_X,
            self::CURSOR_Y + self::SIGNATURE_MARGIN_Y,
            Image::SIGN_WIDTH,
            Image::SIGN_HEIGHT
        );
    }

    private function getContent()
    {
        return $this->trans('cv-sign-content')
            . self::NEW_LINE;
    }
}
