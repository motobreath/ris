'use strict';

/* Controllers */

angular.module('ris.controllers', []).
    controller('search',function($scope,Search) {
        var multiSelect=$('#technology').multipleSelect({
            placeholder: "Click here to select Technology",
            selectAllText:"All Technology"
        });        
        
        $scope.submitForm=function(){
            $scope.searchError="";
            $('.loading').modal();
            setTimeout(function(){
                var searchData={
                    location:$scope.location,
                    building:$scope.building,
                    roomName:$scope.roomName,
                    capacity:$scope.capacity,
                    roomType:$scope.roomType,
                    technology:multiSelect.multipleSelect("getSelects")
                }
                Search.doSearch(searchData).success(function(){
                    $('.loading').modal("hide");
                })
                .error(function(){
                    $scope.searchError="Cannot search at this time. Please try again later."
                    $('.loading').modal("hide");
                    window.scrollTo(0,0);
                });
            },500)
            
            
            return false;
        }
        
    });