<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Model;

use Application\Model\TcpdfInterface;
use Application\Element\MainHeader;
use Application\Element\CareerGoals;
use Application\Element\TechnicalSkills;
use Application\Element\KnownTools;
use Application\Element\PersonalSkills;
use Application\Element\Languages;
use Application\Element\EmploymentHistory;
use Application\Element\Education;
use Application\Element\Hobby;
use Application\Element\AboutMe;

class MainPage
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
        $page = new MainHeader($page);
        $page = new CareerGoals($page);
        $page = new TechnicalSkills($page);
        $page = new KnownTools($page);
        $page = new PersonalSkills($page);
        $page = new Languages($page);
        $page = new EmploymentHistory($page);
        $page = new Education($page);
        $page = new Hobby($page);
        $page = new AboutMe($page);
        
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
