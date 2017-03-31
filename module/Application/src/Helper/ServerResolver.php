<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Helper;

use Application\Config\PdfConfig;
use Zend\View\Helper\ServerUrl;

class ServerResolver
{
    /**
     * @return string
     */
    public static function getHost(): string
    {
        $host = (new ServerUrl())->getHost();
        
        return (getenv('APPLICATION_ENV') === 'development' && !empty($host))
            ? $host
            : PdfConfig::DOCUMENT_HOST;
    }
}
