<?php

/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Decorator;

use Application\Decorator\PdfDocumentDecoratorInterface;
use Application\Decorator\PdfPageDecoratorInterface;
use Application\Model\TcpdfInterface;

abstract class AbstractTcpdfDecorator implements TcpdfInterface, PdfPageDecoratorInterface, PdfDocumentDecoratorInterface
{
    /**
     * @var TcpdfInterface $tcpdf 
     */
    protected $tcpdf;
    
    /**
     * @param TcpdfInterface $tcpdf
     */
    public function __construct(TcpdfInterface $tcpdf)
    {
        $this->tcpdf = $tcpdf;
    }
    
    /**
     * {@inheritDoc}
     * 
     * @return TcpdfInterface
     */
    public function createPage()
    {
        return $this->addElements();
    }
    
    /**
     * {@inheritDoc}
     * 
     * @return TcpdfInterface
     */
    public function addElements()
    {
        $this->tcpdf = $this->tcpdf->addElements();
    }
}
