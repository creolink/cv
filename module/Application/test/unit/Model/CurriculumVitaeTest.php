<?php

namespace Application\Test\Unit\CurriculumVitae;

use Application\Test\Unit\AbstractTest;
use Application\Model\CurriculumVitae;

class CurriculumVitaeTest extends AbstractTest
{
    /**
     * @test
     */
    public function testCVHeader()
    {
        $cv = new CurriculumVitae();
        $cv->setTranslator($this->translator);

        $result = $cv->outputPdf();

        $this->assertNotEmpty($result);
        $this->assertContains('PDF-1.7', $result);
    }
}
