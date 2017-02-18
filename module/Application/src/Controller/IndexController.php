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
use Zend\Http\Response;

class IndexController extends AbstractActionController
{
    /**
     * @return string
     */
    public function indexAction()
    {
        $cvDirector = new CurriculumVitaeDirector(
            new CurriculumVitaeBuilder()
        );
        
        $cvDirector->build();
        
        return $cvDirector->render();
    }

    /**
     * Home page - auto redirect to english site
     *
     * @return Response
     */
    public function homeAction()
    {
        return $this->redirect()->toRoute(
            'subdomain',
            ['subdomain' => 'en']
        );
    }
}
