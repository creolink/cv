<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application;

use Zend\Config\Factory;
use Symfony\Component\Yaml\Parser;

class Module
{
    const VERSION = '3.0.2dev';

    public function init()
    {
        Factory::registerReader( 'yml', 'yaml' );
        
        $decoder = new Parser();
        $reader  = Factory::getReaderPluginManager()->get( 'yaml' );
        $reader->setYamlDecoder( [ $decoder, 'parse' ] );
    }
    
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
