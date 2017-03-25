<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\I18n\Translator;
use Application\Normalization\NormalizedTranslationService;
use Application\Model\CurriculumVitae;
use Application\Builder\CurriculumVitaeDirector;

class BaseController extends AbstractActionController
{
    /**
     * @return NormalizedTranslationService
     */
    protected function getNormalizationService(): NormalizedTranslationService
    {
        return $this->getService(NormalizedTranslationService::class);
    }

    /**
     * @return Translator
     */
    protected function getTranslator(): Translator
    {
        return $this->getService(Translator::class);
    }

    /**
     * @return CurriculumVitaeDirector
     */
    protected function getCurriculumVitae(): CurriculumVitaeDirector
    {
        return $this->getService(CurriculumVitae::class);
    }

    /**
     * @param string $className
     *
     * @return mixed Entry
     */
    protected function getService(string $className)
    {
        return $this->getEvent()
            ->getApplication()
            ->getServiceManager()
            ->get($className);
    }
}
