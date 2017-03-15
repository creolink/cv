<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Entity;

use Application\Entity\EntityInterface;

class Position implements EntityInterface
{
    /**
     * Name of skill
     *
     * @var string
     */
    private $name = '';

    /**
     * Level of skill
     *
     * @var int
     */
    private $level = 1;

    /**
     * Best strength of skill
     *
     * @var type
     */
    private $strength = 4;

    /**
     * Sets skill as disabled
     *
     * @var bool
     */
    private $disabled = false;

    /**
     * @param string $name
     */
    public function setName(string $name = '')
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param int $level
     */
    public function setLevel(int $level)
    {
        $this->level = $level;
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param int $strength
     */
    public function setStrength(int $strength = 4)
    {
        $this->strength = $strength;
    }

    /**
     * @return int
     */
    public function getStrength()
    {
        return $this->strength;
    }

    /**
     * @param bool $disabled
     */
    public function setDisabled(bool $disabled = false)
    {
        $this->disabled = $disabled;
    }

    /**
     * @return bool
     */
    public function isDisabled()
    {
        return $this->disabled;
    }
}
