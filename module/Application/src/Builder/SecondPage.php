<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Builder;

use Application\Model\TcpdfInterface;
use Application\Element\DocumentPage;
use Application\Element\CommisionedJobs;
use Application\Element\QRCode;
use Application\Element\Sign;

class SecondPage
{
    /**
     * @var DocumentPage
     */
    protected $page;
    
    /**
     * @param DocumentPage $page
     */
    public function __construct(DocumentPage $page)
    {
        $this->page = $page;
    }
    
    /**
     * @param DocumentPage $page
     * 
     * @return TcpdfInterface
     */
    public function createElements(DocumentPage $page)
    {
        $page = new CommisionedJobs($page);
        $page = new QRCode($page);
        $page = new Sign($page);
        
        return $page->addElements();
    }
    
    /**
     * @return TcpdfInterface
     */
    public function createPage()
    {
        return $this->createElements(
            $this->page
        );
    }
}
