<?php
/**
 * @copyright 2015-2018 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Customizer;

use Interop\Container\ContainerInterface;
use Application\Factory\AbstractBaseFactory;
use Application\Customizer\CustomizerService;
use Zend\Mvc\I18n\Translator;

class CustomizerServiceFactory extends AbstractBaseFactory
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return CustomizerService
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $translator = $container->get(Translator::class);

        $customizerService = new CustomizerService(
            $this->getCompany($container),
            $translator->getLocale()
        );

        $customizerService->setCustomizedData();

        return $customizerService;
    }

    /**
     * @param ContainerInterface $container
     * @return string
     */
    protected function getCompany(ContainerInterface $container): string
    {
        return $this->getRouteMatch($container)
            ->getParam(CustomizerInterface::ROUTER_CUSTOMIZER_PARAM) ?? '';
    }
}
