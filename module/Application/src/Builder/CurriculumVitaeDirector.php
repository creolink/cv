<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Builder;

use Application\Builder\AbstractDirector;

class CurriculumVitaeDirector extends AbstractDirector
{
    /**
     * {@inheritDoc}
     */
    public function build()
    {
        $this->builder->configure();
        $this->builder->generateMainPage();
        $this->builder->generateSecondPage();
        
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        return $this->builder->render();
    }
}
