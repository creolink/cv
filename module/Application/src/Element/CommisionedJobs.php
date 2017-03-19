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

class CommisionedJobs extends AbstractEmployment
{
    const CURSOR_X = 5;
    const CURSOR_Y = 14;

    const SECTION_WIDTH = 200;

    /**
     * {@inheritDoc}
     */
    public function addElements(): TcpdfInterface
    {
        $this->tcpdf = $this->tcpdf->addElements();

        return $this->renderCommisionedJobs();
    }

    /**
     * @return TcpdfInterface
     */
    private function renderCommisionedJobs(): TcpdfInterface
    {
        $this->renderTitle(
            $this->createSection('cv-commisionedJobs-sectionTitle')
        );

        $this->renderPositions(
            new Hydrator(
                EmploymentPosition::class,
                'commisions.yml'
            )
        );

        return $this->tcpdf;
    }
}
