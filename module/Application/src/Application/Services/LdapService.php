<?php

namespace Application\Services;

use Zend\Ldap\Ldap as Ldap;

class LdapService {

    private $ldap;

    public function __construct(Ldap $ldap){
        $this->ldap=$ldap;
    }

    public function find($ucmnetID){
        return $this->ldap->getEntry("uid=$ucmnetID,ou=People,dc=ucmerced,dc=edu");
    }
    public function search($filter){
        $ldap=$this->ldap;
        $ldap->bind();
        $attributes=array(
            "cn",
            "employeenumber",
            "uid",
            "sn",
            "givenName"
        );
        $ldapResults = $ldap->search($filter,null,Ldap::SEARCH_SCOPE_ONE,$attributes,"sn");
        $results=array();
        foreach ($ldapResults as $item) {
            $data=array(
                "ucmnetID"=>$item['uid'][0],
                "employeeID"=>$item['employeenumber'][0],
                "name"=>$item['cn'][0],
                "fname"=>$item['givenname'][0],
                "lname"=>$item["sn"][0]
            );
            $results[]=$data;
        }
        return $results;
    }
}

?>
