<?php

namespace Application\Form\Validation;

use Zend\InputFilter\InputFilter;

/**
 * Used for creating validators/filters for an element in a form
 */
class ModelFilter extends InputFilter{
    
    /**
     * <b>Parameters:</b> 
     * 
     * <b>$name</b> would be the name of the element from the created form
     * 
     * <b>$required:</b> set the element to be required or not 
     * 
     * <b>$arg1</b> would respresent an array of filters and <b>$arg2</b> would represent an array of validators. However in a Zend\InputFilter\FileInput 
     * the order is reversed. In $arg1 you would pass in validators and in $arg2 you would pass in filters.
     * 
     * <b>$arg1 and $arg2</b> is a represenation of the Factory-backed InputFilter extension method. Therefore pass the array of values into 
     * array parameter as you would following the Factory method without including the key names. The keys are already in the function 
     * classified as $subKeys
     * 
     * <b>$type</b> would be the using the default Zend\InputFilter\InputFilter class unless you wish to use File Validation Classes. 
     * If so, then pass in the parameter Zend\InputFilter\FileInput
     * 
     * @param string $name
     * @param boolean $required
     * @param array|null $arg1
     * @param array|null $arg2
     * @param string|null $type
     */
    protected function createFilter($name, $required, $arg1 = null, $arg2 = null, $type = null ){
        $keys = array('name', 'required', 'filters', 'validators', 'type');
        
        if( $type == 'Zend\InputFilter\FileInput' ){
            $keys[2] = 'validators';
            $keys[3] = 'filters';
        }
        ${$keys[2]} = $arg1;
        ${$keys[3]} = $arg2;
        
        $subKeys = array('name', 'options', 'type');
        
        $i = 0;
        foreach($keys as $key){
            $value = ${$key};
            if( isset( $value ) ){
                if( is_array( $value ) ){
                    foreach( $value as $assignedKey ){
                        foreach( $assignedKey as $subKeyValue ){
                            if( isset( $subKeyValue ) )
                                $filter[ $subKeys[$i++] ] = $subKeyValue;
                            else
                                $i++;
                        }
                        $setFilters[] = $filter;
                        $i = 0;
                    }
                    $arguments[$key] = $setFilters;
                    $setFilters = null;
                }
                else{
                    $arguments[$key] = $value;
                }
            }
        }
        //var_dump($arguments);
        $this->add( $arguments );   
    }
    
    protected function addCustomValidator($name, $validator){
        $input = new \Zend\InputFilter\Input( $name );
        $input->getValidatorChain()
                ->addValidator( $validator );
        parent::add( $input );   
    }
}