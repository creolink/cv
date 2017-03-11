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
    public static function getName()
    {
        return (APPLICATION_ENV === DEVELOPMENT_ENV)
            ? $_SERVER['SERVER_NAME']
            : PdfConfig::DOCUMENT_HOST;
    }
}