<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Api\Controller\Locations' => 'Api\Controller\LocationsController',
            'Api\Controller\Buildings' => 'Api\Controller\BuildingsController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'locations' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/locations[/:id]',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Api\Controller\Locations',
                    ),
                ),
            ),
            'buildings' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/buildings[/:id]',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Api\Controller\Buildings',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'template_map' => array(
            //'layout/layout'           => __DIR__ . '/../../application/view/layout/admin.phtml',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),

    ),
    
);