<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Normalization;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Zend\I18n\Translator\Translator;
use Application\Normalization\NormalizationService;

class NormalizationServiceFactory implements FactoryInterface
{
    /**
     * Create a Normalization instance.
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return Translator
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $translator = $container->get(Translator::class);
        $localization = new NormalizationService($translator);

        return $localization;
    }
}
