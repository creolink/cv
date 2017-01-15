<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Decorator;

interface PdfDocumentDecoratorInterface
{
    /**
     * Creates new CV page
     * 
     * @return CurriculumVitae
     */
    public function createPage();
}
