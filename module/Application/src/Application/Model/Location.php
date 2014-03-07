<?php

namespace Application\Model;

/**
 * Description of Locations
 *
 * @author Chris
 */
class Location {
    
    public $locationID;
    public $location;
    
    public function exchangeArray($data)
    {
        $this->locationID     = (isset($data['locationID'])) ? $data['locationID'] : null;
        $this->location = (isset($data['location'])) ? $data['location'] : null;
    }

    // Add the following method:
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}
