<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Entity;

class SectionTitle
{
    /**
     * Title of section
     *
     * @var string
     */
    private $title = '';

    /**
     * Starting cursor X position
     *
     * @var float
     */
    private $cursorX = 0;

    /**
     * Starting cursor Y position
     *
     * @var type
     */
    private $cursorY = 0;

    /**
     * Width of section
     *
     * @var float
     */
    private $width = 65;

    /**
     * @param string $title
     */
    public function setTitle(string $title = '')
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param float $cursorX
     */
    public function setCursorX(float $cursorX)
    {
        $this->cursorX = $cursorX;
    }

    /**
     * @return float
     */
    public function getCursorX(): float
    {
        return $this->cursorX;
    }

    /**
     * @param float $cursorY
     */
    public function setCursorY(float $cursorY)
    {
        $this->cursorY = $cursorY;
    }

    /**
     * @return float
     */
    public function getCursorY(): float
    {
        return $this->cursorY;
    }

    /**
     * @param float $width
     */
    public function setWidth(float $width)
    {
        $this->width = $width;
    }

    /**
     * @return float
     */
    public function getWidth(): float
    {
        return $this->width;
    }
}
