<?php

namespace Application;

use Zend\Router\Http\Literal;
use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Router\Http\Hostname;

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
    'translator' => [
        'locale' => 'en_US',
        'translation_file_patterns' => [
            [
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ],
        ],
    ],
];