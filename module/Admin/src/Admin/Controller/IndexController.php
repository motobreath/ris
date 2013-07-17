<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    /**
     *
     * @var Zend\Authentication\AuthenticationService\AuthenticationService
     */
    protected $authservice;

    protected $CAS;

    public function getCAS(){
        if(!$this->CAS){
            $this->CAS=$this->getServiceLocator()
                            ->get("CAS");
        }
        return $this->CAS;
    }

    public function indexAction()
    {
        return new ViewModel();
    }
    public function logoutAction(){


    }
}
