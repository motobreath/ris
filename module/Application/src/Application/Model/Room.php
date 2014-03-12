<?php

namespace Application\Model;

/**
 *
 * @author Chris
 */
class Room
{
    public $roomID;
    public $roomName;
    public $roomNumber;
    public $roomCapacity;
    public $locationID;
    public $buildingID;
    public $roomTypeID;
    public $department;
    public $contactPerson;
    public $contactEmail;
    public $bookingLink;
    public $reserve;
    public $roomDetails;
    public $thumbnail;
    public $fullImage;
    public $additionalImagesLink;
    
    public $location;
    public $building;
    public $roomType;
    
    
    public function exchangeArray($data)
    {
        $this->roomID     = (isset($data['roomTypeID'])) ? $data['roomTypeID'] : null;
        $this->roomName = (isset($data['roomName'])) ? $data['roomName'] : null;
        $this->roomNumber = (isset($data['roomNumber'])) ? $data['roomNumber'] : null;
        $this->roomCapacity = (isset($data['roomCapacity'])) ? $data['roomCapacity'] : null;
        $this->locationID = (isset($data['locationID'])) ? $data['locationID'] : null;
        $this->buildingID = (isset($data['buildingID'])) ? $data['buildingID'] : null;
        $this->roomTypeID = (isset($data['roomTypeID'])) ? $data['roomTypeID'] : null;
        $this->department = (isset($data['department'])) ? $data['department'] : null;
        $this->contactPerson = (isset($data['contactPerson'])) ? $data['contactPerson'] : null;
        $this->contactEmail = (isset($data['contactEmail'])) ? $data['contactEmail'] : null;
        $this->bookingLink = (isset($data['bookingLink'])) ? $data['bookingLink'] : null;
        $this->reserve = (isset($data['reserve'])) ? $data['reserve'] : null;
        $this->roomDetails = (isset($data['roomDetails'])) ? $data['roomDetails'] : null;
        $this->thumbnail = (isset($data['thumbnail'])) ? $data['thumbnail'] : null;
        $this->fullImage = (isset($data['fullImage'])) ? $data['fullImage'] : null;
        $this->additionalImagesLink = (isset($data['additionalImagesLink'])) ? $data['additionalImagesLink'] : null;
    }

    // Add the following method:
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
    
}
