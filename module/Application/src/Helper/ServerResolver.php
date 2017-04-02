<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Helper;

use Zend\View\Helper\ServerUrl;

class ServerResolver
{
    /**
     * @var string
     */
    private static $serverName = '';

    /**
     * @return string
     */
    public static function getHost(): string
    {
        return (getenv('APPLICATION_ENV') === 'development')
            ? self::getServerName()
            : (new ServerUrl())->getHost();
    }

    /**
     * @param string $serverName
     */
    public static function setServerName(string $serverName)
    {
        self::$serverName = $serverName;
    }

    /**
     * @return string
     */
    private static function getServerName(): string
    {
        $serverName = self::$serverName;

        if (false === empty($_SERVER['SERVER_NAME'])) {
            $serverName = $_SERVER['SERVER_NAME'];
        }

        return $serverName;
    }
}
