<?php

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

class GetFlashMessages extends AbstractHelper
{

    /* @var $flashMsg Zend\Mvc\Controller\Plugin\FlashMessenger */
    private $flashMessenger;

    public function getFlashMessenger() {
        return $this->flashMessenger;
    }

    public function setFlashMessenger($flashMessenger) {
        $this->flashMessenger = $flashMessenger;
    }

    public function __invoke()
    {
        return $this->getMessages();
    }

    public function getMessages()
    {
        $output="";

        $flashMsg=$this->getFlashMessenger();
        $errors=$flashMsg->getCurrentErrorMessages();

        if(count($errors)>0){
             foreach($errors as $error){
                $output.="<p class='msg error'>$error</p>";
            }

        }
        $successMessages=$flashMsg->getCurrentSuccessMessages();
       
        if(count($successMessages)>0){
            foreach($successMessages as $msg){
                $output.="<p class='msg success'>$msg</p>";
            }
        }

        return $output;
    }
}

?>
