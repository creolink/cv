<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\I18n;

use Interop\Container\ContainerInterface;
use Application\I18n\LocalizationService;
use Application\Factory\AbstractBaseFactory;

class LocalizationServiceFactory extends AbstractBaseFactory
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return LocalizationService
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new LocalizationService(
            $this->getLocale($container)
        );
    }
}
