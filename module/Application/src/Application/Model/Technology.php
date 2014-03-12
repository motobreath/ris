<?php

namespace Application\Model;

/**
 *
 * @author Chris
 */
class Technology {
    
    public $technologyID;
    public $technology;
    
    public function exchangeArray($data)
    {
        $this->technologyID     = (isset($data['technologyID'])) ? $data['technologyID'] : null;
        $this->technology = (isset($data['technology'])) ? $data['technology'] : null;
    }

    // Add the following method:
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}
