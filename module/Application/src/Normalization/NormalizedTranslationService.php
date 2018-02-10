<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Normalization;

use Zend\I18n\Translator\TranslatorInterface;
use Zend\Mvc\I18n\Translator;
use Application\Config\Locale;
use Application\Customizer\CustomizerService;

class NormalizedTranslationService implements TranslatorInterface
{
    /**
     * Characters for normalization
     *
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
     * @var CustomizerService
     */
    private $customizer;

    /**
     * @var string
     */
    private $language = Locale::DEFAULT_LANGUAGE;

    /**
     * @param Translator $translator
     * @param CustomizerService $customizer
     */
    public function __construct(Translator $translator, CustomizerService $customizer)
    {
        $this->translator = $translator;
        $this->customizer = $customizer;
    }

    /**
     * {@inheritDoc}
     */
    public function translate($message, $textDomain = 'default', $locale = null)
    {
        $translatedMessage = $this->customizer->getCustomizedData($message) ?? $this->translator->translate($message);

        return $this->normalize($translatedMessage);
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
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->translator->setLocale($locale);
    }

    /**
     * @param string $language
     */
    public function setLanguage(string $language)
    {
        $this->language = $language;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @return string
     */
    public function getCustomizedCompany()
    {
        return $this->customizer->getCompany();
    }

    /**
     * Removes polish letters from string
     *
     * @param string $message
     * @return string
     */
    private function normalize($message): string
    {
        if (Locale::LOCALE_PL === $this->translator->getLocale()) {
            return $message;
        }

        return strtr(
            $message,
            $this->chars
        );
    }
}
