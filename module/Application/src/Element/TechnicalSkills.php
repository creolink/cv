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

class TechnicalSkills extends AbstractSkills
{
    const CURSOR_X = 5;
    const CURSOR_Y = 77;

    const SECTION_WIDTH = 65;

    /**
     * {@inheritDoc}
     */
    public function addElements(): TcpdfInterface
    {
        $this->tcpdf = $this->tcpdf->addElements();

        return $this->renderElement();
    }

    /**
     * Renders element
     *
     * @return TcpdfInterface
     */
    private function renderElement(): TcpdfInterface
    {
        $this->renderTitle(
            $this->createSection('cv-technicalSkills-sectionTitle')
        );

        $this->renderPositions(
            new Hydrator(
                Skill::class,
                'technical_skills.yml'
            )
        );

        return $this->tcpdf;
    }
}
