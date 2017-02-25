<?php

namespace Application;

use Zend\Router\Http\Literal;
use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Router\Http\Hostname;
use Zend\I18n\Translator\TranslatorServiceFactory;
use Zend\I18n\Translator\Translator;
use Application\Normalization\NormalizedTranslationService;
use Application\Normalization\NormalizedTranslationServiceFactory;
use Application\I18n\LocalizationService;
use Application\I18n\LocalizationServiceFactory;
use Application\Config\Locale;

return [
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
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
                        'controller' => Controller\IndexController::class,
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
                        'controller' => Controller\IndexController::class,
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
            Translator::class => TranslatorServiceFactory::class,
            NormalizedTranslationService::class => NormalizedTranslationServiceFactory::class,
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