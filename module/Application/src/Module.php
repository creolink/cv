<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application;

use Zend\Config\Factory;
use Symfony\Component\Yaml\Parser;
use Zend\Mvc\MvcEvent;
use Zend\I18n\Translator\Translator;
use Application\Model\CurriculumVitaeFactory;
use Application\Model\CurriculumVitae;
use Zend\Di\ServiceLocatorInterface;

class Module
{
    const VERSION = '3.0.2dev';

    /**
     * Initialization
     */
    public function init()
    {
        Factory::registerReader( 'yml', 'yaml' );
        
        $decoder = new Parser();
        
        $reader  = Factory::getReaderPluginManager()->get( 'yaml' );
        $reader->setYamlDecoder([
            $decoder,
            'parse'
        ]);
    }
    
    /**
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
    
    /**
     * @return array
     */
    public function getServiceConfig()
    {
        return [
            'factories' => [
                CurriculumVitae::class => CurriculumVitaeFactory::class,
            ],
        ];
    }
    
    /**
     * @param MvcEvent $mvcEvent
     * @return ServiceLocatorInterface
     */
    private function getServiceManager(MvcEvent $mvcEvent)
    {
        return $mvcEvent->getApplication()
            ->getServiceManager();
    }
    
    /**
     * @param MvcEvent $mvcEvent
     * @return Translator
     */
    private function getTranslator(MvcEvent $mvcEvent)
    {
        return $this->getServiceManager($mvcEvent)
            ->get(Translator::class);
    }
    
    /**
     * @param MvcEvent $mvcEvent
     * @return array
     */
    private function getApplicationConfig(MvcEvent $mvcEvent)
    {
        return $this->getServiceManager($mvcEvent)
            ->get('ApplicationConfig');
    }
    
    /**
     * @param MvcEvent $mvcEvent
     * @return array
     */
    private function getModuleConfig(MvcEvent $mvcEvent)
    {
        return $this->getServiceManager($mvcEvent)
            ->get('Config');
    }
}
