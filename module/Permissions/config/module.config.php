<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'Permissions\Provider\IdentityProvider' => 'Permissions\Provider\IdentityProviderFactory',
        ),
        'invokables' => array(
            'Permissions\View\RedirectionStrategy' => 'Permissions\View\RedirectionStrategy',
        ),
    ),
);