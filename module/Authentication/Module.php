<?php
namespace Authentication;

use Zend\Authentication\AuthenticationService;

class Module
{
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
            'factories' => array(
                'AuthService' => function($sm){
                    $auth = new AuthenticationService();
                    $adapter = new \Authentication\Auth\Adapter\CASAdapter($sm);
                    $adapter->setUserMapper($sm->get("Application\Model\UserMapper"))
                            ->setRoleMapper($sm->get("Application\Model\RoleMapper"));
                    $auth->setAdapter($adapter);
                    return $auth;
                },
            )
        );
    }

}
