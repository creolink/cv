<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Model;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Application\Builder\CurriculumVitaeDirector;
use Application\Builder\CurriculumVitaeBuilder;
use Application\Normalization\NormalizedTranslationService;
use Application\Normalization\NormalizedDateService;
use Application\Customizer\CustomizerService;

class CurriculumVitaeFactory implements FactoryInterface
{
    /**
     * Create a CurriculumVitaeDirector instance.
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return Translator
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $normalizedTranslation = $container->get(NormalizedTranslationService::class);
        $normalizedDate = $container->get(NormalizedDateService::class);
        $customizer = $container->get(CustomizerService::class);

        $cvDirector = new CurriculumVitaeDirector(
            new CurriculumVitaeBuilder(
                $normalizedTranslation,
                $normalizedDate,
                $customizer
            )
        );

        return $cvDirector;
    }
}
