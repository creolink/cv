<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Builder;

use Application\Model\TcpdfInterface;
use Application\Element\DocumentPage;

abstract class AbstractPage
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
     * @return TcpdfInterface
     */
    public function createPage()
    {
        return $this->createElements(
            $this->page
        );
    }
    
    /**
     * @param DocumentPage $page
     * 
     * @return TcpdfInterface
     */
    abstract public function createElements(DocumentPage $page);
}
