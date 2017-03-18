<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Entity;

use Application\Entity\Position;

class Skill extends Position
{
    /**
     * Time of experience in years
     *
     * @var float
     */
    private $experience = 0;

    /**
     * @param float $experience
     */
    public function setExperience(float $experience = 0)
    {
        $this->experience = $experience;
    }

    /**
     * @return float
     */
    public function getExperience(): float
    {
        return $this->experience;
    }
}
