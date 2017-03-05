<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Decorator;

use Application\Model\TcpdfInterface;
use Application\Decorator\AbstractTcpdfDecorator;

abstract class AbstractPageDecorator extends AbstractTcpdfDecorator implements TcpdfInterface
{
    const LINE_WIDTH = 0.2;
    const LINE_DASH = '1';
    const LINE_SOLID = '0';

    /**
     * {@inheritDoc}
     */
    abstract public function addElements();

    /**
     * Sets dashed line style
     */
    protected function setDashedLine()
    {
        $this->tcpdf->SetLineStyle([
            'width' => self::LINE_WIDTH,
            'dash' => self::LINE_DASH,
        ]);
    }

    /**
     * Sets solid line style
     */
    protected function setSolidLine()
    {
        $this->tcpdf->SetLineStyle([
            'width' => self::LINE_WIDTH,
            'dash' => self::LINE_SOLID,
        ]);
    }
}
