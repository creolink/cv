<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\AbstractSection;
use Application\Entity\Position;
use Application\Entity\Skill;
use Application\Config\Font;
use Application\Config\Color;
use Application\Hydrator\Hydrator;

abstract class AbstractSkills extends AbstractSection
{
    const FIRST_LINE_MARGIN = -1;

    const POSITION_NEXT_LINE = 3.6;
    const POSITION_PADDING = 2.3;
    const POSITION_MARGIN = 1.5;
    const POSITION_FONT_SIZE = 8;
    const POSITION_CELL_HEIGHT = 6;

    const CIRCLE_CENTER_POINT_MARGIN = 3.2;
    const CIRCLE_RADIUS = 1.3;
    const CIRCLE_MARGIN = 3.5;
    const CIRCLE_LINE_WIDTH = 0.1;
    const CIRCLE_LINE_DASH = '0';
    const CIRCLE_STYLE = '';
    const CIRCLE_ANGLE_START = 0;
    const CIRCLE_ANGLE_END = 360;

    const FILLED_CIRCLE_RADIUS = 0.9;
    const FILLED_CIRCLE_STYLE = 'F';

    const EXPERIENCE_FONT_SIZE = 5;
    const EXPERIENCE_MARGIN_Y = -0.15;
    const EXPERIENCE_MARGIN_X = 1;

    /**
     * Renders list of skills
     *
     * @param Hydrator $hydrator
     */
    protected function renderPositions(Hydrator $hydrator)
    {
        $x = $this->tcpdf->GetX() + self::POSITION_PADDING;
        $y = $this->tcpdf->GetY() + self::FIRST_LINE_MARGIN;

        $counter = 0;

        foreach ($hydrator->getList() as $position) {
            if ($position->isDisabled()) {
                continue;
            }

            $this->renderCircles(
                $position,
                $x,
                $this->getCircleCenter($y, $counter++)
            );

            $this->renderPosition(
                $position
            );
        }
    }

    /**
     * @param float $y
     * @param int $counter
     * @return float
     */
    private function getCircleCenter($y, $counter)
    {
        return $y
            + (self::POSITION_NEXT_LINE * $counter)
            + self::CIRCLE_CENTER_POINT_MARGIN;
    }

    /**
     * Renders position with circles on left
     *
     * @param Position|Skill $position
     */
    private function renderPosition(Position $position)
    {
        $this->tcpdf->SetXY(
            $this->tcpdf->GetX() + self::POSITION_MARGIN,
            $this->tcpdf->getY()
        );

        $this->tcpdf->SetFont(
            $this->tcpdf->verdana,
            Font::NORMAL,
            self::POSITION_FONT_SIZE
        );

        $name = $this->trans(
            $position->getName()
        );

        $this->tcpdf->Cell(
            $this->tcpdf->GetStringWidth(
                $name
            ),
            self::POSITION_CELL_HEIGHT,
            $name
        );

        $this->renderExperienceTime($position);
    }

    /**
     * @param Position $position
     */
    private function renderExperienceTime(Position $position)
    {
        if ($position instanceof Skill) {
            $this->tcpdf->SetXY(
                $this->tcpdf->GetX() + self::EXPERIENCE_MARGIN_X,
                $this->tcpdf->getY() + self::EXPERIENCE_MARGIN_Y
            );

            $this->tcpdf->SetFont(
                $this->tcpdf->verdanaItalic,
                Font::NORMAL,
                self::EXPERIENCE_FONT_SIZE
            );

            $this->tcpdf->Cell(
                $this->tcpdf->GetStringWidth(
                    $position->getExperience()
                ),
                self::POSITION_CELL_HEIGHT,
                $this->createExperienceText(
                    $position->getExperience()
                )
            );
        }
    }

    /**
     * Renders filled circle
     *
     * @param Position $position
     * @param float $x
     * @param float $y
     */
    private function renderCircles(Position $position, $x, $y)
    {
        for ($counter = 0; $counter < $position->getStrength(); $counter++) {
            $this->renderCircle(
                $x + (self::CIRCLE_MARGIN * $counter),
                $y
            );

            if ($position->getLevel() > $counter) {
                $this->renderFilledCircle(
                    $x + (self::CIRCLE_MARGIN * $counter),
                    $y
                );
            }
        }

        $this->tcpdf->setY(
            $y - self::CIRCLE_CENTER_POINT_MARGIN,
            false
        );
    }

    /**
     * Renders circle
     *
     * @param float $x
     * @param float $y
     */
    private function renderCircle($x, $y)
    {
        $this->tcpdf->Circle(
            $x,
            $y,
            self::CIRCLE_RADIUS,
            self::CIRCLE_ANGLE_START,
            self::CIRCLE_ANGLE_END,
            self::CIRCLE_STYLE,
            $this->getCircleLineStyle()
        );

        $this->tcpdf->SetXY($x, $y);
    }

    /**
     * Renders filled circle
     *
     * @param float $x
     * @param float $y
     */
    private function renderFilledCircle($x, $y)
    {
        $this->tcpdf->Circle(
            $x,
            $y,
            self::FILLED_CIRCLE_RADIUS,
            self::CIRCLE_ANGLE_START,
            self::CIRCLE_ANGLE_END,
            self::FILLED_CIRCLE_STYLE,
            $this->getCircleLineStyle(),
            [
                Color::FILL_COLOR_DARK_RED,
                Color::FILL_COLOR_DARK_GREEN,
                Color::FILL_COLOR_DARK_BLUE,
            ]
        );
    }

    /**
     * Returns line style for circle
     *
     * @return array
     */
    private function getCircleLineStyle()
    {
        return [
            'width' => self::CIRCLE_LINE_WIDTH,
            'dash' => self::CIRCLE_LINE_DASH,
            'color' => [
                Color::DRAW_COLOR_DARK_RED,
                Color::DRAW_COLOR_DARK_GREEN,
                Color::DRAW_COLOR_DARK_BLUE,
            ],
        ];
    }

    /**
     * Creates experience text with proper number of years or month
     *
     * @param float $years
     * @return string
     */
    private function createExperienceText($years = 1)
    {
        if ($years < 1) {
            return sprintf(
                'cv-skills-shortcut-months',
                ceil(12 * $years)
            );
        }

        return sprintf(
            'cv-skills-shortcut-years',
            $years
        );
    }
}
