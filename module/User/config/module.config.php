<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace User;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'user' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/user', // site.com.br/pessoa/incluir/121212112
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'register',
                    ],
                    'my_terminate' => true,
                    'child_routes' => [
                        'default' => [
                            'type' => Segment::class,
                            'options' => [
                                'route' => '[/:action][/token/:token]',
                                'constraints' => [
                                    'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                    'token' => '[[a-f0-9]{32}$]'
                                ]
                            ]
                        ]
                    ],
                ],
            ]
        ],
    ],
    'controllers' => [
        'factories' => [
//            Controller\PessoaController::class => InvokableFactory::class,
        ]
    ],
    'view_manager' => [
        'template_path_stack' => [
            'user' => __DIR__ . '/../view',
        ],
    ]
];
