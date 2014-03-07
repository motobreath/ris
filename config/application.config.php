<?php
$env = getenv('APPLICATION_ENV') ?: 'production';
$configFiles="global,local,development";
if($env=="staging"){
    $configFiles="global,local,staging";
}
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
        'Api',
        'EdpModuleLayouts'
        
        ),
    'module_listener_options' => array(
        'module_paths' => array(
            './module',
            './vendor'
            ),
        'config_glob_paths' => array('config/autoload/{,*.}{' . $configFiles . '}.php')
        )
    );
