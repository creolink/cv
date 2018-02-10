<?php

namespace Application;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Router\Http\Hostname;
use Zend\Mvc\I18n\TranslatorFactory;
use Zend\Mvc\I18n\Translator;
use Application\Controller\IndexController;
use Application\Normalization\NormalizedTranslationService;
use Application\Normalization\NormalizedTranslationServiceFactory;
use Application\I18n\LocalizationService;
use Application\I18n\LocalizationServiceFactory;
use Application\Config\Locale;
use Application\Helper\ServerResolver;
use Application\Normalization\NormalizedDateService;
use Application\Normalization\NormalizedDateServiceFactory;
use Application\Customizer\CustomizerInterface;
use Application\Customizer\CustomizerService;
use Application\Customizer\CustomizerServiceFactory;

return [
    'webhost' => ServerResolver::getHost(),
    'controllers' => [
        'factories' => [
            IndexController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
    ],
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/',
                    'defaults' => [
                        'controller' => IndexController::class,
                        'action' => 'home',
                    ],
                ],
            ],
            'language' => [
                'type' => Hostname::class,
                'options' => [
                    'route' => ':' . Locale::ROUTER_LANGUAGE_PARAM . '.' . ServerResolver::getHost(),
                    'constraints' => [
                        Locale::ROUTER_LANGUAGE_PARAM => Locale::ROUTER_ALLOWED_LANGUAGES,
                    ],
                    'defaults' => [
                        'controller' => IndexController::class,
                        Locale::ROUTER_LANGUAGE_PARAM => Locale::DEFAULT_LANGUAGE,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'language-home' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => sprintf('/[:%s]', CustomizerInterface::ROUTER_CUSTOMIZER_PARAM),
                            'constraints' => [
                                CustomizerInterface::ROUTER_CUSTOMIZER_PARAM => '[a-zA-Z0-9_-]+',
                            ],
                            'defaults' => [
                                'controller' => IndexController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'download' => [
                        'type' => Segment::class,
                        'priority' => 99,
                        'options' => [
                            'route' => sprintf('/download[/:%s]', CustomizerInterface::ROUTER_CUSTOMIZER_PARAM),
                            'constraints' => [
                                CustomizerInterface::ROUTER_CUSTOMIZER_PARAM => '[a-zA-Z0-9_-]+',
                            ],
                            'defaults' => [
                                'controller' => IndexController::class,
                                'action' => 'download',
                            ],
                        ],
                        'may_terminate' => true,
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'factories' => [
            LocalizationService::class => LocalizationServiceFactory::class,
            Translator::class => TranslatorFactory::class,
            NormalizedTranslationService::class => NormalizedTranslationServiceFactory::class,
            NormalizedDateService::class => NormalizedDateServiceFactory::class,
            CustomizerService::class => CustomizerServiceFactory::class,
        ],
    ],
    'translator' => [
        'locale' => Locale::DEFAULT_LOCALE,
        'translation_file_patterns' => [
            [
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ],
        ],
    ],
];
