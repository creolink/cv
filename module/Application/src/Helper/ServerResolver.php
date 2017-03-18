<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Helper;

use Application\Config\PdfConfig;

class ServerResolver
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return (APPLICATION_ENV === DEVELOPMENT_ENV)
            ? $_SERVER['SERVER_NAME']
            : PdfConfig::DOCUMENT_HOST;
    }
}
