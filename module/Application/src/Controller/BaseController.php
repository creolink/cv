<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\I18n\Translator\Translator;
use Application\Normalization\NormalizationService;
use Application\Model\CurriculumVitae;
use Application\Builder\CurriculumVitaeDirector;

class BaseController extends AbstractActionController
{
    /**
     * @param string $className
     * 
     * @return mixed Entry
     */
    protected function getService($className)
    {
        return $this->getEvent()
            ->getApplication()
            ->getServiceManager()
            ->get($className);
    }
    
    /**
     * @return NormalizationService
     */
    protected function getNormalizationService()
    {
        return $this->getService(NormalizationService::class);
    }
    
    /**
     * @return Translator
     */
    protected function getTranslator()
    {
        return $this->getService(Translator::class);
    }
    
    /**
     * @return CurriculumVitaeDirector
     */
    protected function getCurriculumVitae()
    {
        return $this->getService(CurriculumVitae::class);
    }
}
