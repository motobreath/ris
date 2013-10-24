<?php

$env = getenv('APPLICATION_ENV') ?: 'production';
$configFiles="global,local,development";
if($env=="production"){
    $configFiles="global,local,production";
}

return array(
    'modules' => array(
        'Authentication',
        'CAS',
        'SessionModule',
        'BjyAuthorize',
        'Permissions',
        'Application',
        'Admin',
        'EdpModuleLayouts'
        ),
    'module_listener_options' => array(
        'module_paths' => array(
            './module',
            './vendor'
            ),
        'config_glob_paths' => array('config/autoload/{,*.}{global,production,local}.php')
        )
    );
