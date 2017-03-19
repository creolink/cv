<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Mvc\MvcEvent;
use Zend\Router\Http\RouteMatch;
use Application\Config\Locale;

abstract class AbstractBaseFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @return MvcEvent
     */
    protected function getMvcEvent(ContainerInterface $container): MvcEvent
    {
        return $container->get('Application')
                ->getMvcEvent();
    }

    /**
     * @param ContainerInterface $container
     * @return RouteMatch
     */
    protected function getRouteMatch(ContainerInterface $container): RouteMatch
    {
        return $this->getMvcEvent($container)
            ->getRouteMatch();
    }

    /**
     * @param ContainerInterface $container
     * @return string
     */
    protected function getLocale(ContainerInterface $container): string
    {
        return $this->getRouteMatch($container)
            ->getParam(Locale::ROUTER_LANGUAGE_PARAM);
    }
}
