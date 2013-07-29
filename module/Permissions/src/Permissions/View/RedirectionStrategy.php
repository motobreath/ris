<?php

namespace Permissions\View;

use BjyAuthorize\View\RedirectionStrategy as BjyRedirection;

use BjyAuthorize\Exception\UnAuthorizedException;
use Zend\Http\Response;
use Zend\Mvc\Application;
use Zend\Mvc\MvcEvent;
use BjyAuthorize\Guard\Route;
use BjyAuthorize\Guard\Controller;

class RedirectionStrategy extends BjyRedirection
{
    /**
     * Handles redirects in case of dispatch errors caused by unauthorized access
     *
     * @param \Zend\Mvc\MvcEvent $event
     */
    public function onDispatchError(MvcEvent $event){
        // Do nothing if the result is a response object
        $result     = $event->getResult();
        $routeMatch = $event->getRouteMatch();
        $response   = $event->getResponse();
        $router     = $event->getRouter();
        $error      = $event->getError();

        if ($result instanceof Response
            || ! $routeMatch
            || ($response && ! $response instanceof Response)
            || ! (
                Route::ERROR === $error
                || Controller::ERROR === $error
                || (
                    Application::ERROR_EXCEPTION === $error
                    && ($event->getParam('exception') instanceof UnAuthorizedException)
                )
            )
        ) {
            return;
        }
        
        /****************************Start of Additional Code**************************************/
        /**
         * set redirection url and flash message based on requested controller
         */
        $sm = $event->getApplication()->getServiceManager();

        $controller = isset($routeMatch) ? $routeMatch->getParam('controller') : null;
            
        /* @var $flashMessenger \Zend\Mvc\Controller\Plugin\FlashMessenger */
        $flashMessenger = $sm->get('ControllerPluginManager')->get('FlashMessenger');
        $flashMessenger->setNamespace('error')->clearCurrentMessages();
        
        if( isset($controller) ){
            switch( $controller ){
                case 'Admin\Controller\Index':
                case 'users':
                    $this->setRedirectUri('/');
                    $flashMessenger->addErrorMessage('You do not have access');
                    break;
                default: 
                    $this->setRedirectUri('/');
            }
        }
        /****************************End of Additional Code**************************************/
        $url = $this->redirectUri;

        if (null === $url) {
            $url = $router->assemble(array(), array('name' => $this->redirectRoute));
        }

        $response = $response ?: new Response();

        $response->getHeaders()->addHeaderLine('Location', $url);
        $response->setStatusCode(302);

        $event->setResponse($response);
    }
}
