<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Hydrator;

use Application\Entity\EntityInterface;
use Application\Exception\EntityNotFoundException;
use Application\Exception\FileNotFoundException;
use Zend\Hydrator\ClassMethods as ZendHydrator;
use Zend\Config\Factory;

class Hydrator
{
    const PATH = '/../Data/';
    
    /**
     * @var string
     */
    private $entity;
    
    /**
     * @var string
     */
    private $file;
    
    public function __construct($entity, $file)
    {
        $this->file = $file;
        $this->entity = $entity;
    }
    
    /**
     * Hydrates entity
     * 
     * @return EntityInterface
     */
    public function hydrate()
    {
        $positions = [];

        $this->validateClass();
        
        foreach ($this->getFileData() as $position) {
            $positions[] = $this->getHydrator()->hydrate($position, new $this->entity);
        }
        
        return $positions;
    }
    
    /**
     * @return array
     */
    private function getFileData()
    {
        $path = __DIR__ . self::PATH . $this->file;
        
        $this->validateFile($path);
        
        $config = Factory::fromFile($path);
        
        return $config['positions'];
    }
    
    /**
     * @return ZendHydrator
     */
    private function getHydrator()
    {
        return new ZendHydrator();
    }
    
    /**
     * Validates class name
     * 
     * @throws EntityNotFoundException
     */
    private function validateClass()
    {
        if (false === class_exists($this->entity)) {
            throw new EntityNotFoundException(
                sprintf(
                    "Entity '%s' not found.",
                    $this->entity
                )
            );
        }
    }
    
    /**
     * Validates file name
     * 
     * @param string $path
     * @throws EntityNotFoundException
     */
    private function validateFile($path)
    {
        if (false === file_exists($path)) {
            throw new FileNotFoundException(
                sprintf(
                    "Config file '%s' not found.",
                    $path
                )
            );
        }
    }
}
