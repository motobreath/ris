<?php

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Authentication\AuthenticationService as AuthService;

class LoginMenu extends AbstractHelper
{
    /**
     *
     * @var AuthService
     */
    public $auth;

    public function getAuth() {
        return $this->auth;
    }

    public function setAuth($auth) {
        $this->auth = $auth;
    }

    public function __invoke()
    {
        return $this->loginMenu();
    }

    public function loginMenu()
    {
        $auth=$this->getAuth();


        if($auth->hasIdentity()){
            $username=$auth->getIdentity()->name;
            $output= "<li>Welcome $username</li>
                    <li><a href='/'>Home</a></li>
                    <li>|</li>";
            /*
            if($session->user->getIsAdmin()){
                $output.="<li><a href='/admin'>Admin</a></li>
                        <li>|</li>";

            }
             *
             */
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
