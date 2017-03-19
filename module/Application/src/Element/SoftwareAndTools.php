<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\AbstractSkills;
use Application\Entity\Skill;
use Application\Hydrator\Hydrator;
use Application\Model\TcpdfInterface;

class SoftwareAndTools extends AbstractSkills
{
    const CURSOR_X = 72.5;
    const CURSOR_Y = 77;

    const SECTION_WIDTH = 65;

    /**
     * {@inheritDoc}
     */
    public function addElements(): TcpdfInterface
    {
        $this->tcpdf = $this->tcpdf->addElements();

        $this->setSolidLine();

        return $this->renderKnownTools();
    }

    /**
     * @return TcpdfInterface
     */
    private function renderKnownTools(): TcpdfInterface
    {
        $this->renderTitle(
            $this->createSection('cv-softwareTools-sectionTitle')
        );

        $this->renderPositions(
            new Hydrator(
                Skill::class,
                'software.yml'
            )
        );

        return $this->tcpdf;
    }
}
