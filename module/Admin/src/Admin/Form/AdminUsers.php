<?php

namespace Admin\Form;

use Application\Form\ModelForm;

class AdminUsers extends ModelForm{
    
    public function __construct($name = null) {
        parent::__construct('addAdmin');
            
        $this->setAttribute('method', 'post');
        
        $this->addField( 'ucmnetid', 'Text', null, array( 'placeholder' => 'Enter UCMNETID', 'class' => 'adminAdd' ) );
        $this->addField( 'Go', 'Submit', null, array( 'class' => 'button', 'value' => 'Go' ) );
    }
}