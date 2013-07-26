<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Admin\Form;

class UsersController extends AbstractActionController
{
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
    
    public function indexAction(){
        
        $this->getServiceLocator()->get('ViewHelperManager')->get('InlineScript')->appendFile('/js/admin.js');
        
        $form = new Form\AdminUsers();
        $form->setInputFilter( new Form\Validation\AdminFilter( $this->getServiceLocator() ) );

        $request = $this->getRequest();

        if( $request->isPost() ){
            $form->setData( $request->getPost() );
            if( $form->isValid() ){
                $user = new \Application\Model\User();
                $user->exchangeArray( $form->getData() );
                $user->name = $user->ucmnetid;
                
                $userID = $this->getUserMapper()->save($user);
                
                $role = new \Application\Model\Role();
                $role->exchangeArray(array(
                    'id' => 0,
                    'userID' => $userID,
                    'role' => 'admin'
                ));
                $this->getRoleMapper()->save($role);
                
                $this->flashMessenger()->addSuccessMessage("<strong>Success!</strong> Administrator was added. Add another?");
                return $this->redirect()->toUrl('/admin/users');
            }
        }
        
        $this->layout('layout/layout3');
        return array( 'form' => $form );
    }
    
    /**
     * Ajax call
     */
    public function modifyadminAction(){
        $adminID = $this->params()->fromPost('admin');
        
        $this->getUserMapper()->delete($adminID);
        return $this->getRoleMapper()->deleteUser($adminID);
    }
    
    public function getRoleMapper() {
        if( $this->roleMapper == null ){
            $this->roleMapper = $this->getServiceLocator()->get('Application\Model\RoleMapper');
        }
        return $this->roleMapper;
    }

    public function getUserMapper() {
        if( $this->userMapper == null ){
            $this->userMapper = $this->getServiceLocator()->get('Application\Model\UserMapper');
        }
        return $this->userMapper;
    }

}
