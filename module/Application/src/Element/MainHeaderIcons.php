<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Decorator\AbstractTcpdfDecorator;
use Application\Config\Image;
use Application\Config\Color;
use Application\Config\PersonalData;

class MainHeaderIcons extends AbstractTcpdfDecorator
{
    const CONTACT_ICON_CURSOR_Y = 40;
    const CONTACT_ICON_PHONE_CURSOR_X = 58;
    const CONTACT_ICON_EMAIL_CURSOR_X = 86;
    const CONTACT_ICON_SKYPE_CURSOR_X = 123;
    const CONTACT_ICON_LINKED_IN_CURSOR_X = 152;
    const CONTACT_ICON_GOLDEN_LINE_CURSOR_X = 177;

    const CONTACT_LINE_UP_CURSOR_X_START = 0;
    const CONTACT_LINE_UP_CURSOR_X_END = 210;
    const CONTACT_LINE_UP_CURSOR_Y = 39;

    const CONTACT_LINE_DOWN_CURSOR_X_START = 0;
    const CONTACT_LINE_DOWN_CURSOR_X_END = 210;
    const CONTACT_LINE_DOWN_CURSOR_Y = 45;

    /**
     * Renders all contact data
     */
    public function renderContactData()
    {
        $this->tcpdf->SetTextColor(
            Color::TEXT_COLOR_DARK_RED,
            Color::TEXT_COLOR_DARK_GREEN,
            Color::TEXT_COLOR_DARK_BLUE
        );

        $this->renderIcons();

        $this->renderBorderLines();
    }

    /**
     * Renders contact icons
     */
    private function renderIcons()
    {
        $this->renderPhone();
        $this->renderEmail();
        $this->renderSkype();
        $this->renderLinkedIn();
        $this->renderGoldenLine();
    }

    /**
     * Renders email icon and email
     */
    private function renderEmail()
    {
        $this->tcpdf->renderIcon(
            self::CONTACT_ICON_EMAIL_CURSOR_X,
            self::CONTACT_ICON_CURSOR_Y,
            Image::EMAIL,
            PersonalData::EMAIL,
            PersonalData::EMAIL_URL
        );
    }

    /**
     * Renders Skype icon and url
     */
    private function renderSkype()
    {
        $this->tcpdf->renderIcon(
            self::CONTACT_ICON_SKYPE_CURSOR_X,
            self::CONTACT_ICON_CURSOR_Y,
            Image::SKYPE,
            PersonalData::SKYPE,
            PersonalData::SKYPE_URL
        );
    }

    /**
     * Renders LinkedIn icon and url
     */
    private function renderLinkedIn()
    {
        $this->tcpdf->renderIcon(
            self::CONTACT_ICON_LINKED_IN_CURSOR_X,
            self::CONTACT_ICON_CURSOR_Y,
            Image::LINKED_IN,
            PersonalData::LINKED_IN,
            PersonalData::LINKED_IN_URL
        );
    }

    /**
     * Renders phone icon and phone
     */
    private function renderPhone()
    {
        $this->tcpdf->renderIcon(
            self::CONTACT_ICON_PHONE_CURSOR_X,
            self::CONTACT_ICON_CURSOR_Y,
            Image::PHONE,
            PersonalData::PHONE,
            PersonalData::PHONE_URL
        );
    }

    /**
     * Renders GoldenLine icon and url
     */
    private function renderGoldenLine()
    {
        $this->tcpdf->renderIcon(
            self::CONTACT_ICON_GOLDEN_LINE_CURSOR_X,
            self::CONTACT_ICON_CURSOR_Y,
            Image::GOLDEN_LINE,
            PersonalData::GOLDEN_LINE,
            PersonalData::GOLDEN_LINE_URL
        );
    }

    /**
     * Renders lines
     */
    private function renderBorderLines()
    {
        $this->tcpdf->Line(
            self::CONTACT_LINE_UP_CURSOR_X_START,
            self::CONTACT_LINE_UP_CURSOR_Y,
            self::CONTACT_LINE_UP_CURSOR_X_END,
            self::CONTACT_LINE_UP_CURSOR_Y
        );

        $this->tcpdf->Line(
            self::CONTACT_LINE_DOWN_CURSOR_X_START,
            self::CONTACT_LINE_DOWN_CURSOR_Y,
            self::CONTACT_LINE_DOWN_CURSOR_X_END,
            self::CONTACT_LINE_DOWN_CURSOR_Y
        );
    }
}
