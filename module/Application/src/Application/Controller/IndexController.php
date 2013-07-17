<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
    public function layout2Action()
    {
        $this->layout('layout/layout2');
        return new ViewModel();
    }
    public function layout3Action()
    {
        $this->layout('layout/layout3');
        return new ViewModel();
    }
}
