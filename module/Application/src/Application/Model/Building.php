<?php

namespace Application\Model;

/**
 * Description of Locations
 *
 * @author Chris
 */
class Building {
    
    public $buildingID;
    public $locationID;
    public $building;
    
    public function exchangeArray($data)
    {
        $this->buildingID     = (isset($data['buildingID'])) ? $data['buildingID'] : null;
        $this->locationID     = (isset($data['locationID'])) ? $data['locationID'] : null;
        $this->building = (isset($data['building'])) ? $data['building'] : null;
    }

    // Add the following method:
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}
