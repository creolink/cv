<?php

namespace Application;

use Zend\Router\Http\Literal;
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
                    'route'    => '/',
                    'defaults' => [
                        'controller' => IndexController::class,
                        'action'     => 'home',
                    ],
                ],
            ],
            'subdomain' => [
                'type' => Hostname::class,
                'options' => [
                    'route'    => ':' . Locale::ROUTER_LOCALE_PARAM . '.' . $_SERVER['SERVER_NAME'],
                    'constraints' => [
                        'subdomain' => Locale::ALLOWED_ROUTED_LOCALES,
                    ],
                    'defaults' => [
                        'controller' => IndexController::class,
                        'locale' => Locale::DEFAULT_ROUTED_LOCALE,
                        'action'     => 'index',
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