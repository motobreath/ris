<?php

namespace Admin\Validate;

use Zend\Validator\AbstractValidator;

class isAdministrator extends AbstractValidator{

    const INVALID_URL = 'adminAlreadyExists';

    /**
     * @var \Zend\ServiceManager\ServiceManager
     */
    protected $sm;

    protected $messageTemplates = array(
        self::INVALID_URL => "%value% is already an admin.",
    );
    
    public function __construct($sm, $options = null) {
        parent::__construct($options);
        $this->sm = $sm;
    }
    
    public function isValid($value){
        $this->setValue( $value );
        
        /* @var $userMapper \Application\Model\UserTable */
        $userMapper = $this->sm->get('Application\Model\UserMapper');
        $checkUser = $userMapper->find(array(
            "ucmnetid" => $value
        ));
        
        if( $checkUser ){    
            $rows = $this->sm->get('Application\Model\RoleMapper')->fetchAll(array(
                "userID" => $checkUser->id
            ));
            
            foreach($rows as $row){
                if( $row->role === 'admin' ){
                    $this->error( self::INVALID_URL );
                    return false;
                }
            }
        }
        
        return true;
        
    }
}