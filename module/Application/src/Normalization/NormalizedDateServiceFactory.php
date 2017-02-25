<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Normalization;

use Interop\Container\ContainerInterface;
use Application\Factory\AbstractBaseFactory;
use Application\Normalization\NormalizedDateService;
use Application\I18n\LocalizationService;

class NormalizedDateServiceFactory extends AbstractBaseFactory
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return 
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $localizationService = $container->get(LocalizationService::class);

        $normalizedDateService = new NormalizedDateService(
            $localizationService
        );
        
        $normalizedDateService->setFormatter();
        
        return $normalizedDateService;
    }
}
