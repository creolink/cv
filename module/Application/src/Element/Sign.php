<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Decorator\AbstractPageDecorator;
use Application\Config\Image;

class Sign extends AbstractPageDecorator
{
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
        $this->tcpdf->SetDrawColor(200, 200, 200);
        $this->tcpdf->SetLineWidth(0.1);
        $this->tcpdf->Line(35, 255, 150, 255);
        
        $text = 'Should you find my knowledge and professional experience interesting and it could help in progress of your company, please contact with me by phone, by mail or by Skype.';
        
        $this->tcpdf->SetXY(35, 248);
        $this->tcpdf->SetTextColor(90, 90, 90);
        $this->tcpdf->SetFont($this->tcpdf->verdanaItalic, 'I', 7);
        $this->tcpdf->MultiCell(120, 4, $text . "\r\n", 0, 'L', false);
        
        $this->tcpdf->renderImage(Image::SIGN, 50, 250, 90, 25);
        
        return $this->tcpdf;
    }
}
