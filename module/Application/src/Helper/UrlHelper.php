<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Helper;

use Application\Helper\ServerResolver;
use Zend\View\Helper\ServerUrl;

class UrlHelper
{
    /**
     * @param string $language
     * @param string $customization
     *
     * @return string
     */
    public static function getLanguageUrl(string $language, string $customizationUrl = ''): string
    {
        return self::getScheme(). '://'
            . self::getHost($language)
            . $customizationUrl
        ;
    }

    /**
     * @return string
     */
    private static function getScheme():string
    {
        return self::getServerUrl()->getScheme();
    }

    /**
     * @return ServerUrl
     */
    private static function getServerUrl(): ServerUrl
    {
        return new ServerUrl();
    }

    /**
     * @param string $language
     * @return string
     */
    private static function getHost($language): string
    {
        $host = ServerResolver::getHost();

        if ('' !== $language) {
            $host = $language . '.' . $host;
        }

        return $host;
    }
}
