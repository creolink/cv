<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Decorator;

interface PdfPageDecoratorInterface
{
    /**
     * Creates element for PDF Page
     */
    public function addElements();
}
