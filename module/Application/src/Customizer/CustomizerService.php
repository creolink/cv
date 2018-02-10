<?php
/**
 * @copyright 2015-2018 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Customizer;

use Zend\Config\Factory;

class CustomizerService
{
    const PATH = '/../Data/companies/';

    /**
     * @var string
     */
    private $company = '';

    /**
     * @var string
     */
    private $locale = '';

    /**
     * @var array
     */
    private $customizedData = [];

    /**
     * @param string $company
     * @param string $locale
     */
    public function __construct(string $company = '', string $locale = '')
    {
        $this->company = $company;
        $this->locale = $locale;
    }

    /**
     * @param string $translationKey
     * @return string|null
     */
    public function getCustomizedData(string $translationKey)
    {
        return $this->customizedData[$translationKey][$this->locale] ?? null;
    }

    /**
     * @return void
     */
    public function setCustomizedData()
    {
        $this->customizedData = $this->getFileData();
    }

    /**
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @return array
     */
    private function getFileData(): array
    {
        $path = __DIR__ . self::PATH . $this->company . '.yml';

        if (!$this->isFileValid($path)) {
            return [];
        }

        return Factory::fromFile($path);
    }

    /**
     * Validates file name
     *
     * @param string $path
     */
    private function isFileValid(string $path)
    {
        return file_exists($path) && is_file($path);
    }
}
