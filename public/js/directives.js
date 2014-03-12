'use strict';

/* Directives */

angular.module("ris.directives",[])
.directive('locationsDropdown', function() {
    return {
        restrict: 'A',
        require: "ngModel",
        template: "<label for='location'>Location:</label>\
                   <select id='location' class='form-control' ng-model='location' ng-change='updateBuildings()'  ng-options='item.locationID as item.location for item in locations'>\
                       <option value=''> - Any Location - </option>\
                   </select>\
                   <img src='/images/loading.gif' alt='Loading Buildings' ng-show='loadingBuildings'/>\
                   <input type='hidden' name='location' value='{{location}}' />\
                   <br />\
                    <label for='location'>Building:</label>\
                    <select id='building' class='form-control' ng-model='building' ng-options='item.buildingID as item.building for item in buildings'>\
                        <option value=''> - Any Building - </option>\
                    </select>\
                    <input type='hidden' name='building' value='{{building}}' />\
                    <br />",
        controller:function($scope,$http){
            
            $scope.buildings=[{buildingID:0,building:" - Select a Location to show more buildings -"}];
            if(!$scope.locations){
                $http.get("/locations",{cache:true}).success(function(response){
                    $scope.locations=response.locations;
                })
                .error(function(){
                    $scope.searchError="Location search options are not available at this time."
                });            

            }
            
            $scope.updateBuildings=function(){
                $scope.buildings=[];
                $http.get("/buildings?location="+$scope.location).success(function(response){
                    $scope.buildings=response.buildings;
                })
                .error(function(){
                    $scope.searchError="Building search options are not available at this time."                    
                });
            }

        }
    };
})
.directive("roomtypeDropdown",function(){
    return {
        restrict: 'A',
        require: "ngModel",
        template: "<label for='location'>Room Type:</label>\
                   <select id='roomType' class='form-control' ng-model='roomType'  ng-options='item.roomTypeID as item.roomType for item in roomTypes'>\
                       <option value=''> - Any Type - </option>\
                   </select>\
                   <input type='hidden' name='roomType' value='{{roomType}}' />\
                   <br />",
        controller:function($scope,$http){
            
            $scope.roomTypes=[];
            
            $http.get("/room-types",{cache:true}).success(function(response){
                $scope.roomTypes=response.roomTypes;
            })
            .error(function(){
                $scope.searchError="Room type search options are not available at this time."
            });            
            
        }
    }
})
        .directive("capacitySelect",function(){
            return {
                restrict: 'A',
                require: 'ngModel',
                template: "<label for='capacity'>Capacity:</label>\
                          <select id='capacity' class='form-control' ng-model='capacity'  ng-options='k as v for (k , v) in capacities'>\
                            <option value=''> - Any Capacity - </option>\
                          </select>\
                          <input type='hidden' name='capacity' value='{{capacity}}' />\
                          <br />",
                controller:function($scope){
                    $scope.capacities={
                                       "0-10":"0-10",
                                       "10-20":"10-20",
                                       "20-30":"20-30",
                                       "30-40":"30-40",
                                       "50":"50+"
                                   }
                }
            }
})
.directive("technologySelect",function(){
    return {
        restrict: 'A',
        require: "ngModel",
        template: "<label for='technology'>Technology:</label>\
                    <select id='technology' class='form-control' multiple='multiple' ng-model='technology'>\
                        <option ng-repeat='tech in technologies' value='{{tech.technologyID}}'>{{tech.technology}}</option>\
                    </select>\
                    <input type='hidden' name='technology' value='{{technology}}' />\
                    <br />",
        controller:function($scope,$http){       
            //ng-options='item.technologyID as item.technology for item in technologies'
            $scope.technologies=[];
            
            $http.get("/technology",{cache:true}).success(function(response){
                $scope.technologies=response.technology;
                setTimeout(function(){
                    $('#technology').multipleSelect({
                        selectAll:false,
                        multiple:false,
                        placeholder:" - Any Technology -"
                    }); 
                },100)
                
            })
            .error(function(){
                $scope.searchError="Technology search options are not available at this time."
            });            
            
        }
    }
})
.directive('searchResults', ["$timeout",function($timeout) {
        return {
            restrict: 'A',
            templateUrl: "/partials/search-results-table.html",
            scope:true,
            controller: ['$timeout', function($timeout) {
              //  but this controller needs array injection syntax, too!  
            }],
            link : function(scope, element, attrs, ctrl) {
               
               // Doesn't work, shows an empty table:
               // $('.mytable', element).dataTable()   
               // But this does:
              //$timeout(function() { $('#searchResultsTable', element).dataTable(); }, 0)
              //
            }
        }
    }]);
