<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Model;

use Application\Model\TcpdfInterface;
use Application\Element\CommisionedJobs;
use Application\Element\QRCode;
use Application\Element\Sign;

class SecondPage
{
    /**
     * @var TcpdfInterface
     */
    protected $page;
    
    /**
     * @param TcpdfInterface $page
     */
    public function __construct(TcpdfInterface $page)
    {
        $this->page = $page;
    }
    
    /**
     * @param TcpdfInterface $page
     * @return TcpdfInterface
     */
    public function createElements(TcpdfInterface $page)
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
