<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Aula;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'pessoa' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/aula[/:action[/:id]]', // site.com.br/aula/incluir/121212112
                    'constraints'=>[
                        'action'=> '[a-zA-Z][a-zA-Z0-0_-]*',
                        'id'=>'[0-9]+'
                    ],
                    'defaults' => [
                        'controller' => Controller\AulaController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers'=>[
        'factories'=>[
           Controller\AulaController::class => InvokableFactory::class,
        ]
    ],
    'view_manager' => [
        'template_path_stack' => [
            'pessoa'=> __DIR__ . '/../view',
        ],  
    ],
];
