<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Builder;

use Application\Builder\AbstractBuilder;

abstract class AbstractDirector
{
    /**
     * @var AbstractBuilder 
     */
    protected $builder = null;
    
    /**
     * @param AbstractBuilder $builder
     */
    public function __construct(AbstractBuilder $builder)
    {
        $this->builder = $builder;
    }
    
    /**
     * Builds document
     */
    abstract public function build();
    
    /**
     * Renders document
     * 
     * @return string
     */
    abstract public function render();
}
