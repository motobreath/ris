<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Api\Controller\Locations' => 'Api\Controller\LocationsController',
            'Api\Controller\Buildings' => 'Api\Controller\BuildingsController',
            'Api\Controller\RoomTypes' => 'Api\Controller\RoomTypesController',
            'Api\Controller\Technology' => 'Api\Controller\TechnologyController',
            'Api\Controller\Rooms' => 'Api\Controller\RoomsController',
            'Api\Controller\AdditionalImages' => 'Api\Controller\AdditionalImagesController',
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
            'room-types' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/room-types[/:id]',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Api\Controller\RoomTypes',
                    ),
                ),
            ),
            'technology' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/technology[/:id]',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Api\Controller\Technology',
                    ),
                ),
            ),
            'rooms' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/rooms[/:id]',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Api\Controller\Rooms',
                    ),
                ),
            ),
            'additional-images' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/additional-images/room/[/:id]',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Api\Controller\AdditionalImages',
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