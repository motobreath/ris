<?php
return array(
    'router' => array(
        'routes' => array(
            'login' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/login[/:redirect]',
                    'defaults' => array(
                        'controller' => 'Authentication\Controller\Index',
                        'action'     => 'login',
                    ),
                ),
            ),
            'logout' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/logout',
                    'defaults' => array(
                        'controller' => 'Authentication\Controller\Index',
                        'action'     => 'logout',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Authentication\Controller\Index' => 'Authentication\Controller\IndexController'
        ),
    ),
    'controller_plugins' => array(
        'invokables' => array(
            'authenticate' => 'Authentication\Controller\Plugin\Authenticate',
        )
    ),

    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);