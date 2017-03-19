<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Config;

class Locale
{
    const ROUTER_LANGUAGE_PARAM = 'language';
    const ROUTER_ALLOWED_LANGUAGES = 'pl|en|de|xx';

    const DEFAULT_LOCALE = 'en_GB';
    const DEFAULT_LANGUAGE = 'en';

    const LOCALE_XX = 'xx_XX';
    const LANGUAGE_XX = 'xx';

    const LOCALE_EN = 'en_GB';
    const LANGUAGE_EN = 'en';

    const LOCALE_DE = 'de_DE';
    const LANGUAGE_DE = 'de';

    const LOCALE_PL = 'pl_PL';
    const LANGUAGE_PL = 'pl';
}
