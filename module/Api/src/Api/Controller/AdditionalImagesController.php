<?php

namespace Api\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class AdditionalImagesController extends AbstractRestfulController
{
    
    private $mapper;
    
    public function getMapper() {
        if(null===$this->mapper){
            $this->mapper=$this->getServiceLocator()->get("Application\Model\AdditionalImagesMapper");
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
        return new JsonModel();
    }

    public function getList() {
        $mapper=$this->getMapper();
        $results=$mapper->fetchAll($params);
        return new JsonModel(array(
            "additionalImages"=>$results
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
