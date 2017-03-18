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
    public function build(): AbstractDirector
    {
        $this->builder->configure();
        $this->builder->generateMainPage();
        $this->builder->generateSecondPage();

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function render(): string
    {
        return $this->builder->render();
    }
}
