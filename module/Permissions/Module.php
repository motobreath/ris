<?php
namespace Permissions;

use Zend\Mvc\MvcEvent;

class Module
{   
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
        
        $em->getSharedManager()->attach('Admin', 'dispatch', array($this, 'authorize'), 1);
    }
    
    public function authorize(MvcEvent $e){
        $sm = $e->getApplication()->getServiceManager();
        $controllerPlugin = $sm->get('ControllerPluginManager');
        
        $auth = $sm->get('AuthService');
        if( !$auth->hasIdentity() ){
            $forward = $controllerPlugin->get('Forward');
            $forward->dispatch( 'Authentication\Controller\Index', array('action' => 'login') );
        }

        $service = $sm->get('BjyAuthorize\Service\Authorize');
        if( !$service->isAllowed('adminAccess', 'view') ){
            $controllerPlugin->get('FlashMessenger')->addErrorMessage('You do not have access');
            return $controllerPlugin->get('Redirect')->toUrl('/');
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
}
