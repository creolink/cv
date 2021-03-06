<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\AbstractSkills;
use Application\Entity\Position;
use Application\Hydrator\Hydrator;
use Application\Model\TcpdfInterface;

class PersonalTraits extends AbstractSkills
{
    const CURSOR_X = 140;
    const CURSOR_Y = 98.6;

    const SECTION_WIDTH = 65;

    /**
     * {@inheritDoc}
     */
    public function addElements(): TcpdfInterface
    {
        $this->tcpdf = $this->tcpdf->addElements();

        $this->setSolidLine();

        return $this->renderPersonalSkills();
    }

    /**
     * @return TcpdfInterface
     */
    private function renderPersonalSkills(): TcpdfInterface
    {
        $this->renderTitle(
            $this->createSection('cv-personality-sectionTitle')
        );

        $this->renderPositions(
            new Hydrator(
                Position::class,
                'personal_traits.yml'
            )
        );

        return $this->tcpdf;
    }
}
