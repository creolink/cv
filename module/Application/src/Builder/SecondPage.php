<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Builder;

use Application\Builder\AbstractPage;
use Application\Element\DocumentPage;
use Application\Element\CommisionedJobs;
use Application\Element\QRCode;
use Application\Element\Sign;

class SecondPage extends AbstractPage
{
    /**
     * {@inheritDoc}
     */
    public function createElements(DocumentPage $page)
    {
        $page = new CommisionedJobs($page);
        $page = new QRCode($page);
        $page = new Sign($page);
        
        return $page->addElements();
    }
}
