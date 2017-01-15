<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Model;

use Application\Decorator\AbstractPdfDocumentDecorator;

class DocumentPage extends AbstractPdfDocumentDecorator
{
    /**
     * {@inheritDoc}
     */
    public function createPage()
    {
        $this->tcpdf->SetMargins(1, 1, 1);
        
        $this->tcpdf->AddPage();
        
        $this->tcpdf->SetTextColor(0, 0, 0);
        $this->tcpdf->SetFont($this->tcpdf->dejavu, '', 8);
        $this->tcpdf->SetXY(0, 0);
        
        return $this->tcpdf;
    }
    
    /**
     * {@inheritDoc}
     */
    public function addElements()
    {
        return $this->createPage();
    }
}