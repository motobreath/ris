'use strict';

/* Directives */

angular.module("ris.directives",[])
.directive('locationsDropdown', function() {
    return {
        restrict: 'A',
        require: "ngModel",
        template: "<label for='location'>Location:</label>\
                   <select id='location' class='form-control' ng-model='location' ng-change='updateBuildings()'  ng-options='item.locationID as item.location for item in locations'>\
                       <option value=''> - Select - </option>\
                   </select>\
                   <img src='/images/loading.gif' alt='Loading Buildings' ng-show='loadingBuildings'/>\
                   <input type='hidden' name='location' value='{{location}}' />\
                   <br />\
                    <label for='location'>Building:</label>\
                    <select id='building' class='form-control' ng-model='building' ng-options='item.buildingID as item.building for item in buildings'>\
                        <option value=''> - Select - </option>\
                    </select>\
                    <input type='hidden' name='building' value='{{building}}' />\
                    <br />",
        controller:function($scope,Locations,Buildings){
            $scope.buildings=[];
            $scope.locations=[]
            Locations.get().success(function(response){
                $scope.locations=response.locations;
            })
            .error(function(){
                $scope.searchError="Location search options are not available at this time."
            });            
            
            $scope.updateBuildings=function(){
                $scope.buildings=[];
                Buildings.getByLocation().success(function(response){
                    //$scope.buildings=response.buildings;
                })
                .error(function(){
                    $scope.searchError="Building search options are not available at this time."                    
                });
            }
            
            
            
        }
    };
});
