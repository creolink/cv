<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Config;

class Locale
{
    const ROUTER_LOCALE_PARAM = 'locale';

    const DEFAULT_LOCALE = 'en_GB';
    const DEFAULT_ROUTED_LOCALE = 'en';

    const ALLOWED_ROUTED_LOCALES = 'pl|en|de|xx';

    const LOCALE_EN = 'en_GB';
    const ROUTED_LOCALE_EN = 'en';

    const LOCALE_DE = 'de_DE';
    const ROUTED_LOCALE_DE = 'de';

    const LOCALE_PL = 'pl_PL';
    const ROUTED_LOCALE_PL = 'pl';

    const LOCALE_XX = 'xx_XX';
    const ROUTED_LOCALE_XX = 'xx';
}
