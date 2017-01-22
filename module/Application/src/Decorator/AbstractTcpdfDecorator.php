<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Decorator;

use Application\Decorator\PdfPageDecoratorInterface;
use Application\Model\TcpdfInterface;

abstract class AbstractTcpdfDecorator implements TcpdfInterface, PdfPageDecoratorInterface
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
     */
    public function addElements()
    {
        $this->tcpdf = $this->tcpdf->addElements();
    }
}
