<?php

namespace Application\Model;

/**
 * Description of Locations
 *
 * @author Chris
 */
class AdditionalImage {
    
    public $additionalImageID;
    public $roomID;
    public $original;
    public $thumbnail;
    
    
    public function exchangeArray($data)
    {
        $this->additionalImageID     = (isset($data['additionalImageID'])) ? $data['additionalImageID'] : null;
        $this->roomID     = (isset($data['roomID'])) ? $data['roomID'] : null;
        $this->original = (isset($data['original'])) ? $data['original'] : null;
        $this->thumbnail = (isset($data['thumbnail'])) ? $data['thumbnail'] : null;
    }

    // Add the following method:
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}
