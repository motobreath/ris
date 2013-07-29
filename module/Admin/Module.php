<?php

namespace Admin;

class Module{
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig(){

        return array();
    }

    public function getControllerConfig() {
        return array(
            'factories' => array(
                //Suppose one of our routes specifies
                //a controller named 'Admin\Controller\Index'
                'Admin\Controller\Index'    => function($sm) {
                /*
                 * die("Doing controller DI");
                return new \Admin\Controller\IndexController();
                    $sm   = $cm->getServiceLocator();
                    $depA = $sm->get('depA');
                    $depB = $sm->get('depB');
                    $controller = new \MyModule\Controller\MyController($depA,
                                                                        $depB);
                    return $controller;

                 */
                },
            ),
        );
    }
    
    public function getViewHelperConfig(){
        return array(
            'factories' => array(
                'displayAdmins' => function($helperPlugin){
                    return ( new View\Helper\DisplayAdmins( $helperPlugin->getServiceLocator() ) );
                },
            )
        );
    }
}
