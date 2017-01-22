<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Decorator;

use Application\Model\TcpdfInterface;
use Application\Model\CurriculumVitae;

abstract class AbstractTcpdfDecorator implements TcpdfInterface
{
    const LINE_WIDTH = 0.2;
    const LINE_DASH = '1';
    const LINE_SOLID = '0';
    
    /**
     * @var CurriculumVitae $tcpdf 
     */
    protected $tcpdf;
    
    /**
     * @param TcpdfInterface $tcpdf
     */
    public function __construct(TcpdfInterface $tcpdf)
    {
        $this->tcpdf = $tcpdf;
        
        //$this->setDefaults();
    }
    
    /**
     * return TcpdfInterface
     */
    abstract public function addElements();
    
    /**
     * Sets dashed line style
     */
    protected function setDashedLine()
    {
        $this->tcpdf->SetLineStyle([
            'width' => self::LINE_WIDTH,
            'dash' => self::LINE_DASH
        ]);
    }
    
    /**
     * Sets solid line style
     */
    protected function setSolidLine()
    {
        $this->tcpdf->SetLineStyle([
            'width' => self::LINE_WIDTH,
            'dash' => self::LINE_SOLID
        ]);
    }
}
