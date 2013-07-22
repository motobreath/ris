<?php


namespace Authentication\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

 /**
 * Controller plugin to login/logout
 *
 * @author Chris
 */
class Authenticate extends AbstractPlugin
{
    /**
     * Authentication Service
     * @var Zend\Authentication\AuthenticationService
     */
    private $authService;
    private $CAS;

    private function getAuthService(){
        if(null===$this->authService){
            $this->authService=$this->getController()->getServiceLocator()->get('AuthService');
        }
        return $this->authService;
    }

    public function getCAS(){
        if(!$this->CAS){
            $this->CAS=$this->getController()->getServiceLocator()->get('CAS');
        }
        return $this->CAS;
    }

    public function login(){
        $auth=$this->getAuthService();
        if(!$auth->hasIdentity()){

            $result = $auth->authenticate();

            if (!$result->isValid()) {
                return false;
            }

            $auth->getIdentity();

        }

        return true;

    }
    public function logout(){
        //logout locally
        $auth=$this->getAuthService();
        $auth->clearIdentity();
        session_destroy();
        //logout of CAS
        $CAS=$this->getCAS();
        $CAS::client(SAML_VERSION_1_1,"cas.ucmerced.edu",443,"/cas",false);
        $CAS::logoutWithRedirectService("http://" . $_SERVER['SERVER_NAME'] . "/");
    }




}

?>
