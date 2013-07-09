<?php

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Session\Container;

class LoginMenu extends AbstractHelper
{

    public function __invoke()
    {
        return $this->loginMenu();
    }

    public function loginMenu()
    {
        $session=new Container();
        if(isset($session->user)){
            $username=$session->user->getName();
            $output= "<li>Welcome $username</li>
                    <li><a href='/'>Home</a></li>
                    <li>|</li>";
            if($session->user->getIsAdmin()){
                $output.="<li><a href='/admin'>Admin</a></li>
                        <li>|</li>";

            }
            $output.= "<li><a href='/index/logout'>Logout</a></li>";
        }
        else{
            $output = "<li>Welcome Guest</li>
                    <li><a href='/'>Home</a></li>
                    <li>|</li>
                    <li><a href='/index/login'>Login</a></li>";
        }
        return $output;
    }
}

?>
