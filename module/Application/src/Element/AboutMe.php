<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\AbstractBlockTitle;
use Application\Config\PersonalData;
use Application\Config\Font;

class AboutMe extends AbstractBlockTitle
{
    const CURSOR_X = 140;
    const CURSOR_Y = 249;
    
    const WIDTH = 65;
    const CELL_HEIGHT = 4;
    const FONT_SIZE = 7;
    
    /**
     * {@inheritDoc}
     */
    public function addElements()
    {
        $this->tcpdf = $this->tcpdf->addElements();
        
        $this->setSolidLine();
        
        return $this->renderAboutMe();
    }
    
    /**
     * @return type
     */
    private function renderAboutMe()
    {
        $this->renderBlockTitle(
            'About me',
            self::CURSOR_X,
            self::CURSOR_Y,
            self::WIDTH
        );
        
//        $this->tcpdf->SetXY(
//            $this->cursorX,
//            $this->cursorY + 1
//        );
        
        $this->tcpdf->SetFont(
            $this->tcpdf->tahoma,
            Font::NORMAL,
            self::FONT_SIZE
        );
        
        $this->tcpdf->MultiCell(
            self::WIDTH - 2,
            self::CELL_HEIGHT,
            $this->getContent(),
            self::BORDER_NONE,
            self::ALIGN_LEFT
        );
        
        return $this->tcpdf;
    }
    
    /**
     * @return string
     */
    private function getContent()
    {
        return "I am married and we have " . (date("Y") - PersonalData::MAXIMUS_BIRTH_DATE) . " years old son. "
            . "In 2015 we started new life in Germany. "
            . "I don't smoke since " . (date("Y") - PersonalData::STOP_SMOKING_YEAR) . " years. "
            . "In 2016, through regular diet and systematic training, I have lost 35 kg. "
            . "I developed my own PHP framework and I used it in all my commissioned projects. "
            . "I've got references from almost all companies I worked for. "
            . "This CV is an example of my abilities."
            . self::NEW_LINE;
    }
}
