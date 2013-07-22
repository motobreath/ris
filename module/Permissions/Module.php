<?php
namespace Permissions;

use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e){
        $app = $e->getApplication();
        $sm = $app->getServiceManager();
        
        $config = $sm->get('BjyAuthorize\Config');
        $strategy = $sm->get($config['unauthorized_strategy']);

        $em = $app->getEventManager();
        
        $em->attach( 'dispatch.error', function($e) use ($sm, $strategy){
            $pluginManager = $sm->get('ControllerPluginManager');
            
            $routeMatch = $e->getRouteMatch();
            $controller = isset($routeMatch) ? $routeMatch->getParam('controller') : null;
            
            $flashMessenger = $pluginManager->get('FlashMessenger');
            if( isset($controller) ){
                switch( $controller ){
                    case 'Admin\Controller\Index':
                    case 'users':
                        $strategy->setRedirectUri('/');
                        $flashMessenger->addErrorMessage('You do not have access');
                        break;
                    default: 
                        $strategy->setRedirectUri('/');
                }
            }
            
        }, -4999); //execute before dispatch.error redirect
                    
        $em->attach($strategy);
        
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
