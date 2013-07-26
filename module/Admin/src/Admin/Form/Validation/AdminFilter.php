<?php

namespace Admin\Form\Validation;

use Application\Form\Validation\ModelFilter;

class AdminFilter extends ModelFilter{
    
    /**
     * @var \Zend\ServiceManager\ServiceManager
     */
    protected $sm;
    
    public function __construct($sm) {
        
        $this->sm = $sm;
        
        $this->createFilter( 'ucmnetid', true,
            null,
            array(    
                array( 'NotEmpty', array( 'type' => array( 'string', 'space' ) ) ),
            )
        );
        
        $this->addCustomValidator( 'ucmnetid', new \Admin\Validate\isAdministrator( $this->sm ) );
    }
}