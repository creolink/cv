<?php

namespace Application;

use Zend\Router\Http\Literal;
use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Router\Http\Hostname;
use Zend\Mvc\I18n\TranslatorFactory;
use Zend\I18n\Translator\Translator;
use Application\Controller\IndexController;
use Application\Normalization\NormalizedTranslationService;
use Application\Normalization\NormalizedTranslationServiceFactory;
use Application\I18n\LocalizationService;
use Application\I18n\LocalizationServiceFactory;
use Application\Config\Locale;
use Application\Helper\ServerResolver;
use Application\Normalization\NormalizedDateService;
use Application\Normalization\NormalizedDateServiceFactory;

return [
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
                    'route' => ':' . Locale::ROUTER_LANGUAGE_PARAM . '.' . ServerResolver::getName(),
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
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/',
                            'defaults' => [
                                'controller' => IndexController::class,
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'download' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/download',
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
        ]
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
