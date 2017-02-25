<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Normalization;

use Zend\I18n\Translator\TranslatorInterface;

class NormalizedTranslationService implements TranslatorInterface
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
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }
    
    /**
     * {@inheritDoc}
     */
    public function translate($message, $textDomain = 'default', $locale = null)
    {
        return $this->normalize(
            $this->translator->translate($message)
        );
    }
    
    /**
     * {@inheritDoc}
     */
    public function translatePlural(
        $singular,
        $plural,
        $number,
        $textDomain = 'default',
        $locale = null
    ) {
        return $this->normalize(
            $this->translator->translatePlural(
                $singular,
                $plural,
                $number,
                $textDomain,
                $locale
            )
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
