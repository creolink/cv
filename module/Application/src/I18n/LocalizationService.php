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
        Locale::ROUTED_LOCALE_EN => Locale::LOCALE_EN,
        Locale::ROUTED_LOCALE_PL => Locale::LOCALE_PL,
        Locale::ROUTED_LOCALE_DE => Locale::LOCALE_DE,
        Locale::ROUTED_LOCALE_XX => Locale::LOCALE_XX,
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
            $this->locale = Locale::DEFAULT_ROUTED_LOCALE;
        }

        if (false === isset($this->locales[$this->locale])) {
            $this->locale = Locale::DEFAULT_ROUTED_LOCALE;
        }

        return $this->locales[$this->locale];
    }
}
