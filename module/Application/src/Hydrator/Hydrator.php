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

    /**
     * @param string $entity
     * @param string $file
     */
    public function __construct(string $entity, string $file)
    {
        $this->file = $file;
        $this->entity = $entity;
    }

    /**
     * Returns list of entities
     *
     * @return EntityInterface[]
     */
    public function getList(): array
    {
        $list = [];

        $this->validateClass();

        foreach ($this->getFileData() as $record) {
            $list[] = $this->getEntity($record);
        }

        return $list;
    }

    /**
     * Hydrates entity
     *
     * @param array $data
     * @return EntityInterface
     */
    public function getEntity(array $data): EntityInterface
    {
        $entity = $this->entity;

        return $this->getHydrator()
            ->hydrate(
                $data,
                new $entity()
            );
    }

    /**
     * @return array
     */
    private function getFileData(): array
    {
        $path = __DIR__ . self::PATH . $this->file;

        $this->validateFile($path);

        $config = Factory::fromFile($path);

        return $config['positions'];
    }

    /**
     * @return ZendHydrator
     */
    private function getHydrator(): ZendHydrator
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
    private function validateFile(string $path)
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
