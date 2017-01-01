<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Helper\DateHelper;
use TCPDF;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        
        
        $dateHelper = new DateHelper(time());
        
        
        
//        $curriculumVitae = new CurriculumVitae('P', 'mm', 'A4', true, 'UTF-8', false);
//        $curriculumVitae->render();
        
        return new ViewModel();
    }
}
