<?php

namespace Search\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class SearchController extends AbstractRestfulController
{
    
    private $mapper;
    
    public function getMapper() {
        if(null===$this->mapper){
            $this->mapper=$this->getServiceLocator()->get("Search");
        }
        return $this->mapper;
    }
    
    
    
    public function searchAction(){
        $searchParams=$this->params()->fromQuery();
        $results=$this->getMapper()->search($searchParams);
        return new JsonModel(array(
            "rooms"=>$results
        ));
    }

}
