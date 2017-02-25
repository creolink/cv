<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application;

use Zend\Config\Factory;
use Symfony\Component\Yaml\Parser;
use Application\Model\CurriculumVitaeFactory;
use Application\Model\CurriculumVitae;

class Module
{
    const VERSION = '3.0.2dev';

    /**
     * Initialization
     */
    public function init()
    {
        $this->setYamlReader();
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
    
    private function setYamlReader()
    {
        Factory::registerReader('yml', 'yaml');
        
        $decoder = new Parser();
        
        $reader  = Factory::getReaderPluginManager()
            ->get('yaml');
        
        $reader->setYamlDecoder([
            $decoder,
            'parse'
        ]);
    }
}
