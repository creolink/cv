<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Decorator\AbstractTcpdfDecorator;

class DocumentPage extends AbstractTcpdfDecorator
{
    /**
     * {@inheritDoc}
     */
    public function addElements()
    {
        return $this->createPage();
    }
    
    /**
     * @return TcpdfInterface
     */
    private function createPage()
    {
        $this->tcpdf->SetMargins(1, 1, 1);
        
        $this->tcpdf->AddPage();
        
        $this->tcpdf->SetTextColor(50, 50, 50);
        $this->tcpdf->SetFont($this->tcpdf->dejavu, '', 8);
        $this->tcpdf->SetXY(0, 0);
        
        return $this->tcpdf;
    }
}
