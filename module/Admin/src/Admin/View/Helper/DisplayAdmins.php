<?php

namespace Admin\View\Helper;

use Zend\View\Helper\AbstractHelper;

class DisplayAdmins extends AbstractHelper{
    
    /**
     * @var \Zend\ServiceManager\ServiceManager
     */
    protected $sm;
    
    public function __construct($sm){
        $this->sm = $sm;
    }
    
    public function __invoke() {
        $admins = $this->sm->get('Application\Model\UserMapper')->getAdmins();

        return $this->view->partial( 'admin/partials/displayAdmins.phtml', array( 'admins' => $admins ) ); 
    }
}
