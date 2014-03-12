<?php

namespace Search;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

use Search\Model\Search;

use Zend\Mvc\MvcEvent;

class Module{
    public function onBootstrap($e)
    {
        $app = $e->getApplication();
        $em  = $app->getEventManager(); // Specific event manager from App
        $sem = $em->getSharedManager(); // The shared event manager

        $sem->attach(__NAMESPACE__, MvcEvent::EVENT_DISPATCH, function($e) {
            //
        });
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
        return array(
            "factories"=>array(
                "Search"=>function($sm){
                    $search=new Search();
                    $search->setRoomMapper($sm->get("Application\Model\RoomsMapper"));
                    return $search;
                },
            )
        );
                
    }

    public function getControllerConfig() {
        return array(
            'factories' => array(
            ),
        );
    }
    
}
