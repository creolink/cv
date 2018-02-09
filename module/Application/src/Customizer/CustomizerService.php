<?php
/**
 * @copyright 2015-2018 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Customizer;

class CustomizerService
{
    /**
     * @var string $company
     */
    private $company = '';

    public function __construct()
    {
    }

    /**
     * @param string $company
     */
    public function setCompany(string $company = '')
    {
        $this->company = $company;
    }

    /**
     * @return string
     */
    public function getCompany(): string
    {
        return $this->company;
    }
}
