<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\AbstractSection;
use Application\Entity\EmploymentPosition;
use Application\Hydrator\Hydrator;
use Application\Element\EmploymentDate;
use Application\Element\EmploymentCompanyName;
use Application\Element\EmploymentPositionName;
use Application\Element\EmploymentReferences;
use Application\Element\EmploymentExamples;
use Application\Element\EmploymentDescription;
use Application\Element\EmploymentCompanyData;
use Application\Element\EmploymentRecommendation;

abstract class AbstractEmployment extends AbstractSection
{
    const SECTION_WIDTH = 197;

    const FIRST_POSITION_MARGIN = -1;
    const NEXT_POSITION_MARGIN = 2;

    /**
     * Renders list of skills
     *
     * @param Hydrator $hydrator
     */
    protected function renderPositions(Hydrator $hydrator)
    {
        $x = $this->tcpdf->GetX();

        $counter = 0;

        foreach ($hydrator->getList() as $position) {
            if ($position->isDisabled()) {
                continue;
            }

            $this->renderPosition(
                $position,
                $x,
                $this->tcpdf->GetY() + $this->calculatePositionMargin($counter++)
            );
        }
    }

    /**
     * @param int $counter
     * @return float
     */
    private function calculatePositionMargin($counter = 0)
    {
        return ($counter) > 0
                ? self::NEXT_POSITION_MARGIN + self::FIRST_POSITION_MARGIN
                : self::FIRST_POSITION_MARGIN;
    }

    /**
     * @param EmploymentPosition $position
     * @param float $x
     * @param float $y
     */
    private function renderPosition(EmploymentPosition $position, $x, $y)
    {
        $this->renderDate($position, $x, $y);
        $this->renderCompanyName($position, $x, $y);
        $this->renderPositionName($position, $x, $y);
        $this->renderReferences($position, $x, $y);
        $this->renderRecommendation($position, $x, $y);
        $this->renderExamples($position, $x, $y);
        $this->renderDescription($position, $x, $y);
        $this->renderCompanyData($position, $x, $y);
    }

    /**
     * @param EmploymentPosition $position
     * @param float $x
     * @param float $y
     */
    private function renderDate(EmploymentPosition $position, $x, $y)
    {
        $this->getEmploymentDate()
            ->renderDate(
                $position,
                $x,
                $y
            );
    }

    /**
     * @param EmploymentPosition $position
     * @param float $x
     * @param float $y
     */
    private function renderCompanyName(EmploymentPosition $position, $x, $y)
    {
        $employmentCompany = new EmploymentCompanyName($this->tcpdf);

        $employmentCompany->renderCompanyName(
            $position,
            $x + $this->getEmploymentDate()
                ->getWidth($position),
            $y
        );
    }

    /**
     * @return EmploymentDate
     */
    private function getEmploymentDate()
    {
        return new EmploymentDate($this->tcpdf);
    }

    /**
     * @param EmploymentPosition $position
     * @param float $x
     * @param float $y
     */
    private function renderPositionName(EmploymentPosition $position, $x, $y)
    {
        $employmentPositionName = new EmploymentPositionName($this->tcpdf);

        $employmentPositionName->renderPositionName(
            $position,
            $x,
            $y
        );
    }

    /**
     * @param EmploymentPosition $position
     * @param float $x
     * @param float $y
     */
    private function renderReferences(EmploymentPosition $position, $x, $y)
    {
        $employmentReferences = new EmploymentReferences($this->tcpdf);

        $employmentReferences->renderReferences(
            $position,
            $x,
            $y
        );
    }

    /**
     * @param EmploymentPosition $position
     * @param float $x
     * @param float $y
     */
    private function renderRecommendation(EmploymentPosition $position, $x, $y)
    {
        $employmentExamples = new EmploymentRecommendation($this->tcpdf);

        $employmentExamples->renderRecommendation(
            $position,
            $x,
            $y
        );
    }

    /**
     * @param EmploymentPosition $position
     * @param float $x
     * @param float $y
     */
    private function renderExamples(EmploymentPosition $position, $x, $y)
    {
        $employmentExamples = new EmploymentExamples($this->tcpdf);

        $employmentExamples->renderExamples(
            $position,
            $x,
            $y
        );
    }

    /**
     * Renders description of position
     *
     * @param EmploymentPosition $position
     * @param float $x
     * @param float $y
     */
    private function renderDescription(EmploymentPosition $position, $x, $y)
    {
        $employmentDescription = new EmploymentDescription($this->tcpdf);

        $employmentDescription->renderDescription(
            $position,
            $x,
            $y
        );
    }

    /**
     * Renders company data: address, phone, email, person, url, etc..
     *
     * @param EmploymentPosition $position
     * @param float $x
     * @param float $y
     */
    private function renderCompanyData(EmploymentPosition $position, $x, $y)
    {
        $employmentCompanyData = new EmploymentCompanyData($this->tcpdf);

        $employmentCompanyData->renderCompanyData(
            $position,
            $x,
            $y
        );
    }
}
