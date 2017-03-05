<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\EmploymentDocuments;
use Application\Entity\EmploymentPosition;
use Application\Element\EmploymentReferencesInterface;
use Application\Element\EmploymentRecommendationInterface;

class EmploymentExamples extends EmploymentDocuments implements EmploymentReferencesInterface, EmploymentRecommendationInterface
{
    const DOWNLOAD_ICON_MARGIN = 5.5;
    const DOWNLOAD_DOCUMENT_FONT_SIZE = 7;

    const EXAMPLES_CELL_WIDTH = 195;
    const EXAMPLES_CELL_HEIGHT = 2.2;
    const EXAMPLES_MARGIN = 5.5;

    /**
     * @param EmploymentPosition $position
     * @param float $x
     * @param float $y
     */
    public function renderExamples(EmploymentPosition $position, $x, $y)
    {
        if ($position->hasExamples()) {
            $examples = $position->getExamples();

            $this->configure();

            $this->tcpdf->SetXY($x, $y + self::EXAMPLES_MARGIN);

            $this->tcpdf->Cell(
                self::EXAMPLES_CELL_WIDTH - $this->calculateMargin($position),
                self::EXAMPLES_CELL_HEIGHT,
                $this->trans('cv-employment-examples'),
                self::BORDER_NONE,
                self::CELL_LINE_NONE,
                self::ALIGN_RIGHT,
                self::TRANSPARENT,
                $examples
            );

            $this->renderDownloadIcon($y, $examples);
        }
    }

    /**
     * @param EmploymentPosition $position
     *
     * @return float
     */
    private function calculateMargin(EmploymentPosition $position)
    {
        $margin = 0;

        if ($position->hasReferences()) {
            $margin += $this->tcpdf->GetStringWidth(
                $this->trans('cv-employment-references')
            ) + self::REFERENCES_CELL_PADDING;
        }

        if ($position->hasRecommendation()) {
            $margin += $this->tcpdf->GetStringWidth(
                $this->trans('cv-employment-recommendations')
            ) + self::RECOMMENDATION_CELL_PADDING;
        }

        return $margin;
    }
}
