<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\EmploymentDocuments;
use Application\Entity\EmploymentPosition;
use Application\Element\EmploymentRecommendationInterface;

class EmploymentRecommendation extends EmploymentDocuments implements EmploymentRecommendationInterface
{
    const DOWNLOAD_ICON_MARGIN = 5.5;
    const DOWNLOAD_DOCUMENT_FONT_SIZE = 7;

    /**
     * @param EmploymentPosition $position
     * @param float $x
     * @param float $y
     */
    public function renderRecommendation(EmploymentPosition $position, $x, $y)
    {
        if ($position->hasRecommendation()) {
            $recommendation = $position->getRecommendation();

            $this->configure();

            $this->tcpdf->SetXY($x, $y + self::RECOMMENDATION_MARGIN);

            $this->tcpdf->Cell(
                self::RECOMMENDATION_CELL_WIDTH,
                self::RECOMMENDATION_CELL_HEIGHT,
                $this->trans('cv-employment-recommendations'),
                self::BORDER_NONE,
                self::CELL_LINE_NONE,
                self::ALIGN_RIGHT,
                self::TRANSPARENT,
                $recommendation
            );

            $this->renderDownloadIcon($y, $recommendation);
        }
    }
}
