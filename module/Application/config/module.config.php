<?php

namespace Application;

use Zend\Router\Http\Literal;
use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Router\Http\Hostname;
use Zend\Mvc\I18n\Router\TranslatorAwareTreeRouteStack;
use Zend\I18n\Translator\TranslatorServiceFactory;
use Zend\I18n\Translator\Translator;
use Application\Normalization\NormalizedLocalizationService;
use Application\Normalization\NormalizedLocalizationServiceFactory;

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
        'router_class' => TranslatorAwareTreeRouteStack::class,
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
                    'route'    => ':subdomain.' . $_SERVER['SERVER_NAME'],
                    'constraints' => [
                        'subdomain' => 'pl|en|de',
                    ],
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'subdomain' => 'en',
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'factories' => [
            Translator::class => TranslatorServiceFactory::class,
            NormalizedLocalizationService::class => NormalizedLocalizationServiceFactory::class,
        ],
    ],
    'translator' => [
        'locale' => 'en_GB',
        'translation_file_patterns' => [
            [
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ],
        ],
    ],
];