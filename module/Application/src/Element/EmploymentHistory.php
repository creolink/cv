<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\AbstractEmployment;
use Application\Entity\SectionTitle;
use Application\Entity\EmploymentPosition;
use Application\Hydrator\Hydrator;

class EmploymentHistory extends AbstractEmployment
{
    const CURSOR_X = 5;
    const CURSOR_Y = 143;

    const SECTION_WIDTH = 200;

    /**
     * {@inheritDoc}
     */
    public function addElements()
    {
        $this->tcpdf = $this->tcpdf->addElements();

        $this->setSolidLine();

        return $this->renderEmploymentHistory();
    }

    /**
     * @return TcpdfInterface
     */
    private function renderEmploymentHistory()
    {
        $this->renderTitle(
            $this->createSectionTitle()
        );

        $this->renderPositions(
            new Hydrator(
                EmploymentPosition::class,
                'contracts.yml'
            )
        );

        return $this->tcpdf;
    }

    /**
     * @return SectionTitle
     */
    private function createSectionTitle()
    {
        $sectionTitle = new SectionTitle();
        $sectionTitle->setCursorX(self::CURSOR_X);
        $sectionTitle->setCursorY(self::CURSOR_Y);
        $sectionTitle->setTitle(
            $this->trans('cv-employmentHistory-sectionTitle')
        );
        $sectionTitle->setWidth(self::SECTION_WIDTH);

        return $sectionTitle;
    }
}
