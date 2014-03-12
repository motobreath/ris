<?php

namespace Application\Model;

/**
 *
 * @author Chris
 */
class RoomsTable extends Mapper {
    public function fetchAll($params = array()) {
        $select = $this->tableGateway->getSql()->select()
        ->join('buildings', 'rooms.buildingID=buildings.buildingID')
        ->join('locations', 'rooms.locationID=locations.locationID')
        ->join('roomTypes', 'rooms.roomTypeID=roomTypes.roomTypeID');
        
        $resultSet = $this->tableGateway->selectWith($select);
        
        $results=array();
        foreach($resultSet as $rs){
            $results[]=$rs;
        }
       
        return $results;
        
    }
    
    public function get($id){
        $select = $this->tableGateway->getSql()->select()
        ->join('buildings', 'rooms.buildingID=buildings.buildingID')
        ->join('locations', 'rooms.locationID=locations.locationID')
        ->join('roomTypes', 'rooms.roomTypeID=roomTypes.roomTypeID')
        ->where(array("rooms.roomID"=>$id));
        $resultSet=$this->tableGateway->selectWith($select);
        return $resultSet->current();
        
                
    }
}
