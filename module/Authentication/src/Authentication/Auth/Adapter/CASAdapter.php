<?php

/**
 * CAS authentication adapter for Zend\Authenticate
 *
 * @author Chris
 */

namespace Authentication\Auth\Adapter;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result as AuthenticationResult;
use Application\Model\User;

class CASAdapter implements AdapterInterface
{
    /**
     * Service Manager
     * @var Zend\ServiceManager\ServiceManager
     */
    private $sm;

    /**
     * User Mapper (Table Gateway UserTable)
     * @var \Application\Model\UserTable
     */
    private $userMapper;

    /**
     * Role Mapper (Table Gateway RoleTable)
     * @var \Application\Model\RoleTable
     */
    private $roleMapper;

    public function __construct($sm){
        $this->sm=$sm;
    }

    public function getRoleMapper() {
        return $this->roleMapper;
    }

    public function setRoleMapper($roleMapper) {
        $this->roleMapper = $roleMapper;
    }

    public function getUserMapper() {
        return $this->userMapper;
    }

    public function setUserMapper($userMapper) {
        $this->userMapper = $userMapper;
        return $this;
    }

    /**
     * Performs an authentication attempt
     *
     * @return \Zend\Authentication\Result
     * @throws \Zend\Authentication\Adapter\Exception\ExceptionInterface
     *               If authentication cannot be performed
     *
     * TODO: Implement try catch with exception if cas doesn't work
     */
    public function authenticate() {

        /* @var $CAS \phpCAS */
        $CAS = $this->sm->get("CAS");
        $CAS::client(SAML_VERSION_1_1,"cas.ucmerced.edu",443,"/cas",false);
        $CAS::setNoCasServerValidation();
        $CAS::forceAuthentication();
        $ucmnetID = $CAS::getUser();
        $attributes = $CAS::getAttributes();

        //create user, save
        $userMapper=$this->getUserMapper();

        $checkUser=$userMapper->find(array(
            "ucmnetid"=>$ucmnetID
        ));
        $userID="";
        if($checkUser){
            $userID=$checkUser->id;
        }
        $userData=array(
            "id"=>$userID,
            "ucmnetid"=>$ucmnetID,
            "name"=>$attributes["cn"]
        );

        $user=new User();
        $user->exchangeArray($userData);

        $userID=$userMapper->save($user);

        //find roles from userID returned by save
        $rows=$this->roleMapper->fetchAll(array(
            "userID"=>$userID
        ));
        $results=array();
        foreach($rows as $row){
            $results[]=$row->role;
        }
        if(empty($results)){
            $results[]="guest";
        }
        $user->roles=$results;

        //save user into Result
        return new AuthenticationResult(1,$user);

    }

}

?>
