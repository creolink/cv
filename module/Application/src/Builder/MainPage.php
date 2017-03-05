<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Builder;

use Application\Builder\AbstractPage;
use Application\Element\MainHeader;
use Application\Element\CareerGoals;
use Application\Element\TechnicalSkills;
use Application\Element\SoftwareAndTools;
use Application\Element\PersonalTraits;
use Application\Element\Languages;
use Application\Element\EmploymentHistory;
use Application\Element\Education;
use Application\Element\Hobby;
use Application\Element\AboutMe;
use Application\Model\TcpdfInterface;

class MainPage extends AbstractPage
{
    /**
     * {@inheritDoc}
     */
    public function createElements(TcpdfInterface $page)
    {
        $page = new MainHeader($page);
        $page = new CareerGoals($page);
        $page = new TechnicalSkills($page);
        $page = new SoftwareAndTools($page);
        $page = new PersonalTraits($page);
        $page = new Languages($page);
        $page = new EmploymentHistory($page);
        $page = new Education($page);
        $page = new Hobby($page);
        $page = new AboutMe($page);

        return $page->addElements();
    }
}
