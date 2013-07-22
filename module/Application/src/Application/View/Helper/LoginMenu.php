<?php

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

class LoginMenu extends AbstractHelper
{
    /**
     * @var \Zend\ServiceManager\ServiceManager
     */
    protected $sm;
    
    public function __construct($sm){
        $this->sm = $sm;
    }

    public function __invoke()
    {
        return $this->loginMenu();
    }

    public function loginMenu()
    {   
        $auth = $this->sm->get('AuthService');

        if( $auth->hasIdentity() ){
            $username = $auth->getIdentity()->name;
            $output = "<li>Welcome $username</li>
                    <li><a href='/'>Home</a></li>
                    <li>|</li>";
            
            $authorize = $this->sm->get('BjyAuthorize\Service\Authorize');
            if( $authorize->isAllowed('adminNav', 'view') ){
                $output.="<li><a href='/admin'>Admin</a></li>
                        <li>|</li>";
            }
            
            $output.= "<li><a href='/logout'>Logout</a></li>";
        }
        else{
            $output = "<li>Welcome Guest</li>
                    <li><a href='/'>Home</a></li>
                    <li>|</li>
                    <li><a href='/login'>Login</a></li>";
        }
        return $output;
    }
}

?>
