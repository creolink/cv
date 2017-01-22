<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 * @version 2.0.1
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Application\Builder\CurriculumVitaeBuilder;
use Application\Builder\CurriculumVitaeDirector;

class IndexController extends AbstractActionController
{
    /**
     * @return string
     */
    public function indexAction()
    {
        $director = new CurriculumVitaeDirector(
            new CurriculumVitaeBuilder()
        );
        
        $director->build();
        
        return $director->render();
    }
}
