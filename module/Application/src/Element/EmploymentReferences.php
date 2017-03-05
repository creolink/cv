<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\EmploymentDocuments;
use Application\Entity\EmploymentPosition;

class EmploymentReferences extends EmploymentDocuments
{
    const REFERENCES_MARGIN = 5.5;
    const REFERENCES_CELL_WIDTH = 195;
    const REFERENCES_CELL_HEIGHT = 2.2;
    const REFERENCES_CELL_PADDING = 6;

    const DOWNLOAD_ICON_MARGIN = 5.5;
    const DOWNLOAD_DOCUMENT_FONT_SIZE = 7;

    /**
     * @param EmploymentPosition $position
     * @param float $x
     * @param float $y
     */
    public function renderReferences(EmploymentPosition $position, $x, $y)
    {
        if ($position->hasReferences()) {
            $references = $position->getReferences();

            $this->configure();

            $this->tcpdf->SetXY($x, $y + self::REFERENCES_MARGIN);

            $this->tcpdf->Cell(
                self::REFERENCES_CELL_WIDTH,
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
}
