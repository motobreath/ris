<?php

namespace Application\Model;

/**
 *
 * @author Chris
 */
class RoomType {
    
    public $roomTypeID;
    public $roomType;
    
    public function exchangeArray($data)
    {
        $this->roomTypeID     = (isset($data['roomTypeID'])) ? $data['roomTypeID'] : null;
        $this->roomType = (isset($data['roomType'])) ? $data['roomType'] : null;
    }

    // Add the following method:
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}
