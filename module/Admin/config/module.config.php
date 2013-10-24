<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Index' => 'Admin\Controller\IndexController',
            'users' => 'Admin\Controller\UsersController'
        ),
    ),
    'router' => array(
        'routes' => array(
            'admin' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/admin',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/users',
                            'defaults' => array(
                                "controller"=>"users",
                                "action"=>"index"
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'modify-admin' => array(
                                'type'    => 'Segment',
                                'options' => array(
                                    'route'    => '/modifyadmin',
                                    'defaults' => array(
                                        "controller"=>"users",
                                        "action"=>"modifyadmin"
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'module_layouts' => array(
        'Admin' => 'layout/admin.phtml',
    ),
);