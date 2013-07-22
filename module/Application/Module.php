<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Application\View\Helper\LoginMenu;

use Application\Model\User;
use Application\Model\UserTable;
use Application\Model\Role;
use Application\Model\RoleTable;


use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
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
                'Application\Model\UserMapper' =>  function($sm) {
                    $tableGateway = $sm->get('UserTableGateway');
                    $table = new UserTable($tableGateway);
                    return $table;
                },
                'UserTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new User());
                    return new TableGateway('users', $dbAdapter, null, $resultSetPrototype);
                },
                'Application\Model\RoleMapper' =>  function($sm) {
                    $tableGateway = $sm->get('RoleTableGateway');
                    $table = new UserTable($tableGateway);
                    return $table;
                },
                'RoleTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Role());
                    return new TableGateway('roles', $dbAdapter, null, $resultSetPrototype);
                },
            )

        );
    }

    public function getViewHelperConfig(){
        return array(
            "factories"=>array(
                "loginMenu" => function(\Zend\View\HelperPluginManager $pluginManager){
                    $locator = $pluginManager->getServiceLocator();
                    $loginMenu = new LoginMenu($locator);
                    return $loginMenu;
                },
                "getFlashMessages" => function(\Zend\View\HelperPluginManager $pluginManager){
                    $locator = $pluginManager->getServiceLocator();
                    $flashMessenger = $locator->get('ControllerPluginManager')->get('flashMessenger');
                    $viewHelper=new \Application\View\Helper\GetFlashMessages();
                    $viewHelper->setFlashMessenger($flashMessenger);
                    return $viewHelper;
                },

            )
        );
    }

}
