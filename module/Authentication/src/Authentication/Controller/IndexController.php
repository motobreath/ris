<?php

namespace Authentication\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function loginAction()
    {
        $isLoggedIn=$this->authenticate()->login();
        if(!$isLoggedIn){
            $this->flashMessenger()->addSuccessMessage("Cannot login at this time. Please try again later");
            $this->redirect()->toUrl("/");
        }
        return new ViewModel();

    }
    public function logoutAction()
    {
        $this->authenticate()->logout();
    }
}
