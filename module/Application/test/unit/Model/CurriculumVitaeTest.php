<?php

namespace Application\Test\Unit\CurriculumVitae;

use Application\Test\Unit\AbstractTest;
use Application\Model\CurriculumVitae;

/**
 * @coversDefaultClass \Application\Model\CurriculumVitae
 */
class CurriculumVitaeTest extends AbstractTest
{
    /**
     * @covers ::outputPdf
     */
    public function testCVIsNotEmpty()
    {
        $result = $this->getCV()->outputPdf();

        $this->assertNotEmpty($result);
        $this->assertContains('PDF-1.7', $result);
    }

    /**
     * @return CurriculumVitae
     */
    private function getCV(): CurriculumVitae
    {
        $cv = new CurriculumVitae();

        $cv->configure();
        $cv->initFonts();
        $cv->setTranslator($this->translator);

        return $cv;
    }
}
