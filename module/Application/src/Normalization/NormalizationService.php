<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Normalization;

use Zend\I18n\Translator\Translator;

class NormalizationService
{
    /**
     * Characters for normalization
     * @var type 
     */
    private $chars = [
        'ę' => 'e',
        'ó' => 'o',
        'ą' => 'a',
        'ś' => 's',
        'ł' => 'l',
        'ż' => 'z',
        'ź' => 'z',
        'ć' => 'c',
        'ń' => 'n',
        'Ę' => 'E',
        'Ó' => 'O',
        'Ą' => 'A',
        'Ś' => 'S',
        'Ł' => 'L',
        'Ż' => 'Z',
        'Ź' => 'Z',
        'Ć' => 'C',
        'Ń' => 'N',
    ];
    
    /**
     * @var Translator
     */
    private $translator;
    
    /**
     * @param Translator $translator
     */
    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }
    
    /**
     * @param string $message
     * 
     * @return string
     */
    public function trans($message)
    {
        return $this->translator->translate(
            $this->normalize($message)
        );
    }
    
    /**
     * Removes polish letters from string
     * 
     * @param string $message
     */
    private function normalize($message)
    {
        return strtr(
            $message,
            $this->chars
        );
    }
}
