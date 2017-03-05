<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Decorator\AbstractTcpdfDecorator;
use Application\Config\Color;
use Application\Config\Image;
use Application\Config\PersonalData;

class MainHeaderPersonalPhoto extends AbstractTcpdfDecorator
{
    const PERSONAL_PHOTO_CURSOR_X = 19;
    const PERSONAL_PHOTO_CURSOR_Y = 5;
    const PERSONAL_PHOTO_WIDTH = 30;
    const PERSONAL_PHOTO_HEIGHT = 37;

    /**
     * Renders personal photo in header
     */
    public function renderPersonalPhoto()
    {
        $this->tcpdf->SetDrawColor(
            Color::DRAW_COLOR_BRIGHT_RED,
            Color::DRAW_COLOR_BRIGHT_GREEN,
            Color::DRAW_COLOR_BRIGHT_BLUE
        );

        $this->tcpdf->renderImage(
            Image::PERSONAL_PHOTO,
            self::PERSONAL_PHOTO_CURSOR_X,
            self::PERSONAL_PHOTO_CURSOR_Y,
            self::PERSONAL_PHOTO_WIDTH,
            self::PERSONAL_PHOTO_HEIGHT,
            PersonalData::EMAIL_URL
        );

        $this->tcpdf->Rect(
            self::PERSONAL_PHOTO_CURSOR_X,
            self::PERSONAL_PHOTO_CURSOR_Y,
            self::PERSONAL_PHOTO_WIDTH,
            self::PERSONAL_PHOTO_HEIGHT
        );
    }
}
