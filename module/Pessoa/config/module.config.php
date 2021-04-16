<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Pessoa;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'pessoa' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/pessoa[/:action[/:id]]', // site.com.br/pessoa/incluir/121212112
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+'
                    ],
                    'defaults' => [
                        'controller' => Controller\PessoaController::class,
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
//            Controller\PessoaController::class => InvokableFactory::class,
        ]
    ],
    'view_manager' => [
        'template_path_stack' => [
            'pessoa' => __DIR__ . '/../view',
        ],
    ],
    'db' => [
        'driver' => 'Pdo_Mysql',
        'database' => 'youtube',
        'username' => 'zend',
        'password' => 'dev123',
        'hostname' => '127.0.0.1'
    ]
];
