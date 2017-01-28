<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\AbstractSkills;
use Application\Entity\SectionTitle;
use Zend\Config\Factory;
use Zend\Hydrator\ClassMethods as Hydrator;
use Application\Entity\Skill;

class TechnicalSkills extends AbstractSkills
{
    const CURSOR_X = 5;
    const CURSOR_Y = 77;
    
    const SECTION_WIDTH = 65;
    
    /**
     * {@inheritDoc}
     */
    public function addElements()
    {
        $this->tcpdf = $this->tcpdf->addElements();
        
        return $this->renderElement();
    }
    
    /**
     * Renders element
     * 
     * @return TcpdfInterface
     */
    private function renderElement()
    {
        $this->renderTitle(
            $this->createSectionTitle()
        );
        
        $this->renderPositions(
            $this->getPositions(
                Factory::fromFile(__DIR__.'/../Data/technical_skills.yml'),
                Skill::class
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
        $sectionTitle->setTitle('Technical experience');
        $sectionTitle->setWidth(self::SECTION_WIDTH);
        
        return $sectionTitle;
    }
    
//    /**
//     * Returns array of skill objects
//     * 
//     * @return Skill[]
//     */
//    private function getSkills()
//    {
//        $config = Factory::fromFile(__DIR__.'/../Data/technical_skills.yml');
//        
//        $skills = [];
//        $hydrator = new Hydrator();
//        
//        $objectName = Skill::class;
//        
//        if (!class_exists($objectName)) {
//            die('aaa');
//        }
//        
//        $object = new $objectName;
//        
//        foreach ($config['skills'] as $skill) {
//            $skills[] = $hydrator->hydrate($skill, new $object);
//        }
//        
//        return $skills;
//    }
}
