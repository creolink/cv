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

class Languages extends AbstractSkills
{
    const CURSOR_X = 140;
    const CURSOR_Y = 77;

    const SECTION_WIDTH = 65;

    /**
     * {@inheritDoc}
     */
    public function addElements(): TcpdfInterface
    {
        $this->tcpdf = $this->tcpdf->addElements();

        $this->setSolidLine();

        return $this->renderLanguages();
    }

    /**
     * @return TcpdfInterface
     */
    private function renderLanguages(): TcpdfInterface
    {
        $this->renderTitle(
            $this->createSection('cv-languages-sectionTitle')
        );

        $this->renderPositions(
            new Hydrator(
                Position::class,
                'languages.yml'
            )
        );

        return $this->tcpdf;
    }
}
