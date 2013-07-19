<?php
namespace Permissions;

use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\Http\RouteMatch;

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
            
            //var_dump( $e->getRouteMatch() );
            //die();
            $controller = $e->getRouteMatch()->getParam('controller');
            switch( $controller ){
                case 'Admin\Controller\Index':
                case 'users':
                    $strategy->setRedirectUri('/login');
                    break;
                default: 
                    $strategy->setRedirectUri('/');
            }
            
            $flashMessenger = $pluginManager->get('FlashMessenger');
            $flashMessenger->setNamespace('Error')->addMessage('You do not have access');
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
