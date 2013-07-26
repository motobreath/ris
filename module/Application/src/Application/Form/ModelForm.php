<?php

namespace Application\Form;

use Zend\Form\Form;

/**
 * Used for the creation of forms. Classes would extend from this class which inherits from
 * from the Zend Form Class.
 */
class ModelForm extends Form{
    
    /**
     * Parameters are key values for when adding the element. Pass in values as you would by Factory-backed Form Extension method
     * 
     * Link provided below to check out the method mentioned
     * @link http://zf2.readthedocs.org/en/latest/modules/zend.form.quick-start.html
     * 
     * @param string $name
     * @param string $type
     * @param array|null $options
     * @param array|null $attributes
     */
    protected function addField($name, $type, $options = null, $attributes = null ){
        $keys = array('name', 'type', 'options', 'attributes');
        
        $type = 'Zend\Form\Element\\' . $type;

        foreach($keys as $key){
            $value = ${$key};
            if( isset( $value ) ){
                $arguments[$key] = $value;
            }
        }

        $this->add( $arguments );   
    }
}
