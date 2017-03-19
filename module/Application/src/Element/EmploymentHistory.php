<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\AbstractEmployment;
use Application\Entity\EmploymentPosition;
use Application\Hydrator\Hydrator;
use Application\Model\TcpdfInterface;

class EmploymentHistory extends AbstractEmployment
{
    const CURSOR_X = 5;
    const CURSOR_Y = 144;

    const SECTION_WIDTH = 200;

    /**
     * {@inheritDoc}
     */
    public function addElements(): TcpdfInterface
    {
        $this->tcpdf = $this->tcpdf->addElements();

        $this->setSolidLine();

        return $this->renderEmploymentHistory();
    }

    /**
     * @return TcpdfInterface
     */
    private function renderEmploymentHistory(): TcpdfInterface
    {
        $this->renderTitle(
            $this->createSection('cv-employmentHistory-sectionTitle')
        );

        $this->renderPositions(
            new Hydrator(
                EmploymentPosition::class,
                'contracts.yml'
            )
        );

        return $this->tcpdf;
    }
}
