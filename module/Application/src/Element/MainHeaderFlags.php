<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Decorator\AbstractTcpdfDecorator;
use Application\Config\Image;
use Application\Helper\UrlHelper;

class MainHeaderFlags extends AbstractTcpdfDecorator
{
    const FLAGS_CURSOR_X = 11;
    const FLAGS_CURSOR_Y = 6;

    const FLAG_EN_MARGIN = 0;
    const FLAG_DE_MARGIN = 4;
    const FLAG_PL_MARGIN = 8;

    /**
     * Renders flags / CV languages & URL
     */
    public function renderFlags()
    {
        $this->renderFlag(
            Image::FLAG_EN,
            'en',
            self::FLAG_EN_MARGIN
        );

        $this->renderFlag(
            Image::FLAG_DE,
            'de',
            self::FLAG_DE_MARGIN
        );

        $this->renderFlag(
            Image::FLAG_PL,
            'pl',
            self::FLAG_PL_MARGIN
        );
    }

    /**
     * Renders flag with URL
     *
     * @param string $flag
     * @param string $language
     * @param float $margin
     */
    private function renderFlag(string $flag = '', string $language = '', float $margin = 0)
    {
        $this->tcpdf->renderImage(
            $flag,
            self::FLAGS_CURSOR_X,
            self::FLAGS_CURSOR_Y + $margin,
            Image::FLAG_WIDTH,
            Image::FLAG_HEIGHT,
            UrlHelper::getLanguageUrl($language, $this->getCustomizationUrl())
        );

        $this->tcpdf->Rect(
            self::FLAGS_CURSOR_X,
            self::FLAGS_CURSOR_Y + $margin,
            Image::FLAG_WIDTH,
            Image::FLAG_HEIGHT
        );
    }
}
