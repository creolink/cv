<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Decorator\AbstractTcpdfDecorator;
use Application\Entity\EmploymentPosition;
use Application\Config\Font;
use Application\Config\Color;

class EmploymentCompanyData extends AbstractTcpdfDecorator
{
    const SECTION_WIDTH = 197;

    const COMPANY_URL_MARGIN = 0.3;

    const COMPANY_DATA_FONT_SIZE = 6.5;
    const COMPANY_DATA_MARGIN_Y = 0.2;
    const COMPANY_DATA_MARGIN_X = 1;
    const COMPANY_DATA_PADDING = 2.5;

    const CONTACT_CELL_HEIGHT = 1;
    const CONTACT_SEPARATOR = ', ';

    /**
     * @var float
     */
    private $companyUrlWidth = 0;

    /**
     * @param EmploymentPosition $position
     * @param float $x
     * @param float $y
     */
    public function renderCompanyData(EmploymentPosition $position, float $x, float $y)
    {
        if ($position->hasCompanyData()) {
            $this->configure();

            $y = $this->tcpdf->GetY() + self::COMPANY_DATA_MARGIN_Y;

            $this->renderCompanyUrl(
                $position,
                $x + self::COMPANY_DATA_MARGIN_X,
                $y
            );

            $this->renderContact(
                $position,
                $x + self::COMPANY_DATA_MARGIN_X,
                $y
            );

            $this->tcpdf->SetXY(
                $x,
                $y + self::COMPANY_DATA_PADDING
            );
        }
    }

    /**
     * Configures element
     */
    private function configure()
    {
        $this->tcpdf->SetTextColor(
            Color::TEXT_COLOR_LIGHT_RED,
            Color::TEXT_COLOR_LIGHT_GREEN,
            Color::TEXT_COLOR_LIGHT_BLUE
        );

        $this->tcpdf->SetFont(
            $this->tcpdf->tahoma,
            Font::NORMAL,
            self::COMPANY_DATA_FONT_SIZE
        );
    }

    /**
     * @param EmploymentPosition $position
     * @param float $x
     * @param float $y
     */
    private function renderCompanyUrl(EmploymentPosition $position, float $x, float $y)
    {
        $this->companyUrlWidth = 0;

        if ($position->hasCompanyUrl()) {
            $this->tcpdf->SetXY($x, $y);

            $companyUrl = $position->getCompanyUrl();

            $this->tcpdf->Cell(
                self::SECTION_WIDTH,
                self::CONTACT_CELL_HEIGHT,
                $companyUrl,
                self::BORDER_NONE,
                self::CELL_LINE_NONE,
                self::ALIGN_RIGHT,
                self::TRANSPARENT,
                $companyUrl
            );

            $this->setCompanyUrlWidth($position);
        }
    }

    /**
     * @param EmploymentPosition $position
     */
    private function setCompanyUrlWidth(EmploymentPosition $position)
    {
        $this->companyUrlWidth = $this->tcpdf->GetStringWidth(
            $position->getCompanyUrl()
        ) + self::COMPANY_URL_MARGIN;
    }

    /**
     * @param EmploymentPosition $position
     * @param float $x
     * @param float $y
     */
    private function renderContact(EmploymentPosition $position, float $x, float $y)
    {
        if ($position->hasContact() || $position->hasCompanyAddress()) {
            $this->tcpdf->SetXY($x, $y);

            $this->tcpdf->Cell(
                self::SECTION_WIDTH - $this->companyUrlWidth,
                self::CONTACT_CELL_HEIGHT,
                $this->createCompanyData($position),
                self::BORDER_NONE,
                self::CELL_LINE_NONE,
                self::ALIGN_RIGHT
            );
        }
    }

    /**
     * @param EmploymentPosition $position
     * @return string
     */
    private function createCompanyData(EmploymentPosition $position): string
    {
        return $this->createContactText($position)
            . $this->createAddressText($position);
    }

    /**
     * @param EmploymentPosition $position
     * @return string
     */
    private function createContactText(EmploymentPosition $position): string
    {
        $text = '';

        if ($position->hasContact()) {
            $text = $this->trans('cv-employment-contact');
            $text .= $this->trans(
                $position->getContact()
            );

            if ($position->hasCompanyAddress()
                || ($position->hasCompanyUrl() && false === $position->hasCompanyAddress())
            ) {
                $text .= self::CONTACT_SEPARATOR;
            }
        }

        return $text;
    }

    /**
     * @param EmploymentPosition $position
     * @return string
     */
    private function createAddressText(EmploymentPosition $position): string
    {
        $text = '';

        if ($position->hasCompanyAddress()) {
            $text = $this->trans('cv-employment-address');

            if ($position->hasAddress()) {
                $text .= $this->trans(
                    $position->getAddress()
                );
            }

            if ($position->hasAddress() && $position->hasCountry()) {
                $text .= self::CONTACT_SEPARATOR;
            }

            if ($position->hasCountry()) {
                $text .= $this->trans(
                    $position->getCountry()
                );
            }

            if ($position->hasCompanyUrl()) {
                $text .= self::CONTACT_SEPARATOR;
            }
        }

        return $text;
    }
}
