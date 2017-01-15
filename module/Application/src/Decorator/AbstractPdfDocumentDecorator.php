<?php

/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Decorator;

use Application\Decorator\PdfDocumentDecoratorInterface;
use Application\Decorator\PdfPageDecoratorInterface;

abstract class AbstractPdfDocumentDecorator implements PdfPageDecoratorInterface, PdfDocumentDecoratorInterface
{
    /**
     * @var PdfDocumentDecoratorInterface $tcpdf 
     */
    protected $tcpdf;
    
    /**
     * @param PdfDocumentDecoratorInterface $tcpdf
     */
    public function __construct(PdfDocumentDecoratorInterface $tcpdf)
    {
        $this->tcpdf = $tcpdf;
    }
    
    /**
     * {@inheritDoc}
     */
    public function createPage()
    {
        return $this->tcpdf->createPage();
    }
    
    /**
     * {@inheritDoc}
     */
    public function addElements()
    {
        return $this->createPage();
    }
}
