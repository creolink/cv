<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Builder;

use Application\Model\TcpdfInterface;

abstract class AbstractPage
{
    /**
     * @var TcpdfInterface 
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
     * @return TcpdfInterface
     */
    public function createPage()
    {
        $this->tcpdf->SetMargins(1, 1, 1);
        
        $this->tcpdf->AddPage();
        
        $this->tcpdf->SetTextColor(50, 50, 50);
        $this->tcpdf->SetFont($this->tcpdf->dejavu, '', 8);
        $this->tcpdf->SetXY(0, 0);
        
        return $this->createElements(
            $this->tcpdf
        );
    }
    
    /**
     * @param TcpdfInterface $page
     * 
     * @return TcpdfInterface
     */
    abstract public function createElements(TcpdfInterface $page);
}
