<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Normalization;

use Interop\Container\ContainerInterface;
use Zend\Mvc\I18n\Translator;
use Application\Normalization\NormalizedTranslationService;
use Application\I18n\LocalizationService;
use Application\Config\Locale;
use Application\Factory\AbstractBaseFactory;
use Application\Customizer\CustomizerService;

class NormalizedTranslationServiceFactory extends AbstractBaseFactory
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return Translator
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $localizationService = $container->get(LocalizationService::class);

        $translator = $container->get(Translator::class);
        $translator->setLocale($localizationService->getLocale())
            ->setFallbackLocale(Locale::DEFAULT_LOCALE);

        $customizer = $container->get(CustomizerService::class);

        $normalizedTranslationService = new NormalizedTranslationService($translator, $customizer);
        $normalizedTranslationService->setLanguage(
            $this->getLocale($container)
        );

        return $normalizedTranslationService;
    }
}
