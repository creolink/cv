<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Decorator\AbstractTcpdfDecorator;
use Application\Config\PersonalData;
use Application\Config\PdfConfig;
use Application\Config\Images;

class QRCode extends AbstractTcpdfDecorator
{
    const BORDER = false;
    const VERTICAL_PADDING = 'auto';
    const HORIZONTAL_PADDING = 'auto';
    const FONT_COLOR_RED = 0;
    const FONT_COLOR_GREEN = 0;
    const FONT_COLOR_BLUE = 0;
    const BACKGROUND_COLOR = false;
    const MODULE_WIDTH = 1;
    const MODILE_HEIGHT = 1;
    const ALIGN = 'M';
    
    const BARCODE_TYPE = 'QRCODE,L';
    const BARCODE_WIDTH = 50;
    const BARCODE_HEIGHT = 50;
    
    const PDF_CURSOR_X = 155;
    const PDF_CURSOR_Y = 220;
    
    /**
     * {@inheritDoc}
     */
    public function addElements()
    {
        parent::addElements();
        
        return $this->renderQRCode();
    }
    
    private function renderQRCode()
    {
        $style = array(
            'border' => self::BORDER,
            'vpadding' => self::VERTICAL_PADDING,
            'hpadding' => self::HORIZONTAL_PADDING,
            'fgcolor' => [
                self::FONT_COLOR_RED,
                self::FONT_COLOR_GREEN,
                self::FONT_COLOR_BLUE
            ],
            'bgcolor' => self::BACKGROUND_COLOR,
            'module_width' => self::MODULE_WIDTH,
            'module_height' => self::MODILE_HEIGHT
        );

        $text = 'BEGIN:VCARD'. "\n"
            . 'VERSION:2.1' . "\n"
            . 'FN:' . PdfConfig::DOCUMENT_AUTHOR . "\n"
            . 'TITLE:' . PersonalData::TITLE . "\n"
            . 'TEL:' . PersonalData::PHONE . "\n"
            . 'EMAIL:' . PersonalData::EMAIL . "\n"
            . 'PHOTO;PNG:' . Images::PHOTO_URL . "\n"
            . 'ADR:;;' . PersonalData::STREET . ';'
                . PersonalData::CITY . ';;'
                . PersonalData::POST_CODE . ';'
                . PersonalData::COUNTRY . "\n"
            . 'URL:' . PdfConfig::DOCUMENT_URL . "\n"
            . 'END:VCARD';

        $this->tcpdf->write2DBarcode(
            $text,
            self::BARCODE_TYPE,
            self::PDF_CURSOR_X,
            self::PDF_CURSOR_Y,
            self::BARCODE_WIDTH,
            self::BARCODE_HEIGHT,
            $style,
            self::ALIGN
        );
        
        return $this->tcpdf;
    }
}
