<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Application\Helper\DateHelper;
use Application\Model\CurriculumVitae;
use Application\Service\GenerateCVService;


class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $generateCVService = new GenerateCVService(
            new CurriculumVitae('P', 'mm', 'A4', true, 'UTF-8', false),
            new DateHelper(time())
        );

        return $generateCVService->renderCV();
    }
}
