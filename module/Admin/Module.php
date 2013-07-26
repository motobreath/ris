<?php

namespace Admin;

use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\MvcEvent;

class Module
{

    public function init(ModuleManager $moduleManager)
    {
        $events = $moduleManager->getEventManager();

        $sharedEvents = $events->getSharedManager();
        $sharedEvents->attach(__NAMESPACE__, 'dispatch', array($this, 'authorize'), 1);
    }

    public function onBootstrap(MvcEvent $e){
        $app = $e->getApplication();
        $sm = $app->getServiceManager();
        $em = $app->getEventManager();
        
        $auth = $sm->get('AuthService');
        if( !$auth->hasIdentity() ){
            $guards = $sm->get('BjyAuthorize\Guards');
            foreach ($guards as $guard) {
                $guard->detach( $em );
            }
        }
    }
    
    public function authorize(MvcEvent $e){
        $sm = $e->getApplication()->getServiceManager();
        $auth = $sm->get("AuthService");
        if( !$auth->hasIdentity() ){
            $forward = $sm->get("ControllerPluginManager")->get("Forward");
            $forward->dispatch('Authentication\Controller\Index', array("action"=>"login"));
        }
        
        $service = $sm->get('BjyAuthorize\Service\Authorize');
        if( !$service->isAllowed('adminAccess', 'view') ){
            $sm->get('ControllerPluginManager')->get('FlashMessenger')->addErrorMessage('You do not have access');
            return $sm->get("ControllerPluginManager")->get("Redirect")->toUrl('/');
        }
    }


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
