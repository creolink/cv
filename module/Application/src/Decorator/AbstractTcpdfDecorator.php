<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Decorator;

use Application\Model\CurriculumVitae;
use Application\Decorator\TcpdfDecoratorInterface;
use Application\Model\TcpdfInterface;

abstract class AbstractTcpdfDecorator implements TcpdfDecoratorInterface
{
    /**
     * @var CurriculumVitae|TcpdfInterface $tcpdf 
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
     * @param string $message
     * @return string
     */
    protected function trans($message)
    {
        return $this->tcpdf->getTranslator()->trans($message);
    }
}
