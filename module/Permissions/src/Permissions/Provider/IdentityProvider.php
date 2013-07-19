<?php

namespace Permissions\Provider;

use BjyAuthorize\Provider\Identity\ProviderInterface;
use BjyAuthorize\Exception\InvalidRoleException;
use Zend\Permissions\Acl\Role\RoleInterface;

class IdentityProvider implements ProviderInterface{
    
    /**
     * Class that would potentially be used by the authentication service
     * @var \Application\Model\User
     */
    protected $user;
    
    /**
     * @var string|\Zend\Permissions\Acl\Role\RoleInterface
     */    
    protected $defaultRole;
    
    public function __construct($user = null) {
        
        $this->user = $user;
    }
    
    public function getIdentityRoles() {
       
        if( $this->user == null )
            return array( $this->getDefaultRole() );
        
        return $this->user->roles;
    }
    
    /**
     * @return string|\Zend\Permissions\Acl\Role\RoleInterface
     */
    public function getDefaultRole(){
        return $this->defaultRole;
    }
    
    /**
     * @param string|\Zend\Permissions\Acl\Role\RoleInterface $defaultRole
     *
     * @throws \BjyAuthorize\Exception\InvalidRoleException
     */
    public function setDefaultRole($defaultRole)
    {
        if (! ($defaultRole instanceof RoleInterface || is_string($defaultRole))) {
            throw InvalidRoleException::invalidRoleInstance($defaultRole);
        }

        $this->defaultRole = $defaultRole;
    }
}