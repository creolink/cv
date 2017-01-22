<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\AbstractBlockTitle;

class AboutMe extends AbstractBlockTitle
{
    const CURSOR_X = 140;
    const CURSOR_Y = 249;
    
    /**
     * {@inheritDoc}
     */
    public function addElements()
    {
        $this->tcpdf = $this->tcpdf->addElements();
        
        return $this->renderAboutMe();
    }
    
    private function renderAboutMe()
    {
        $this->renderBlockTitle('About me', self::CURSOR_X, self::CURSOR_Y, 65);
        
        $text = "I am married and we have " . (date("Y") - 2005) . " years old son. "
            ."In 2015 we started new life in Germany. "
            ."I don't smoke since " . (date("Y") - 2006) . " years. "
            ."In 2016, through regular diet and systematic training, I have lost 35 kg. "
            ."I developed my own PHP framework and I used it in all my commissioned projects. "
            ."I've got references from almost all companies I worked for. "
            ."This CV is an example of my abilities.";
        
        $this->tcpdf->SetXY($this->tcpdf->cursorPositionX, $this->tcpdf->cursorPositionY + 1);
        $this->tcpdf->SetFont($this->tcpdf->tahoma, '', 7);
        $this->tcpdf->MultiCell(63, 4, $text . "\r\n", 0, 'L', false);
        
        return $this->tcpdf;
    }
}
