<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\I18n;

use Application\Config\Locale;

class LocalizationService
{
    /**
     * @var string
     */
    private $locale;

    /**
     * @var array
     */
    private $locales = [
        Locale::LANGUAGE_EN => Locale::LOCALE_EN,
        Locale::LANGUAGE_PL => Locale::LOCALE_PL,
        Locale::LANGUAGE_DE => Locale::LOCALE_DE,
        Locale::LANGUAGE_XX => Locale::LOCALE_XX,
    ];

    /**
     * @param string $routedLocale
     */
    public function __construct(string $routedLocale)
    {
        $this->locale = $routedLocale;
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        if (empty($this->locale)) {
            $this->locale = Locale::DEFAULT_LANGUAGE;
        }

        if (false === isset($this->locales[$this->locale])) {
            $this->locale = Locale::DEFAULT_LANGUAGE;
        }

        return $this->locales[$this->locale];
    }
}
