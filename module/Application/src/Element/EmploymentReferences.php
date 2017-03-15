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

class EmploymentReferences extends EmploymentDocuments implements EmploymentReferencesInterface, EmploymentRecommendationInterface
{
    const DOWNLOAD_ICON_MARGIN = 5.5;
    const DOWNLOAD_DOCUMENT_FONT_SIZE = 7;

    /**
     * @param EmploymentPosition $position
     * @param float $x
     * @param float $y
     */
    public function renderReferences(EmploymentPosition $position, float $x, float $y)
    {
        if ($position->hasReferences()) {
            $references = $position->getReferences();

            $this->configure();

            $this->tcpdf->SetXY($x, $y + self::REFERENCES_MARGIN);

            $this->tcpdf->Cell(
                self::REFERENCES_CELL_WIDTH - $this->calculateMargin($position),
                self::REFERENCES_CELL_HEIGHT,
                $this->trans('cv-employment-references'),
                self::BORDER_NONE,
                self::CELL_LINE_NONE,
                self::ALIGN_RIGHT,
                self::TRANSPARENT,
                $references
            );

            $this->renderDownloadIcon($y, $references);
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

        if ($position->hasRecommendation()) {
            $margin += $this->tcpdf->GetStringWidth(
                $this->trans('cv-employment-recommendations')
            ) + self::RECOMMENDATION_CELL_PADDING;
        }

        return $margin;
    }
}
