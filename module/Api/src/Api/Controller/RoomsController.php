<?php

namespace Api\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class RoomsController extends AbstractRestfulController
{
    
    private $mapper;
    
    public function getMapper() {
        if(null===$this->mapper){
            $this->mapper=$this->getServiceLocator()->get("Application\Model\RoomsMapper");
        }
        return $this->mapper;
    }
    
    public function create($data) {
        
        return new JsonModel(array(
            "status"=>"success"
        ));
    }

    public function delete($id) {
        return new JsonModel();
    }

    public function deleteList() {
        return new JsonModel();
    }

    public function get($id) {
        $mapper=$this->getMapper();
        $room=$mapper->get($id);        
        
        return new JsonModel(array(
            "room"=>$room
        ));
    }

    public function getList() {
        $mapper=$this->getMapper();
        $results=$mapper->fetchAll();
        return new JsonModel(array(
            "rooms"=>$results
        ));
    }

    public function patch($id, $data) {
        return new JsonModel();
    }

    public function replaceList($data) {
        return new JsonModel();
    }

    public function update($id, $data) {
        return new JsonModel();
    }

}
