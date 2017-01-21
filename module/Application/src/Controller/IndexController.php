<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 * @version 2.0.1
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Application\Model\CurriculumVitae;
use Application\Service\GenerateCVService;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $generateCVService = new GenerateCVService(
            new CurriculumVitae()
        );

        return $generateCVService->renderCV();
    }
}
