'use strict';

/* Controllers */

angular.module('ris.controllers', [])
    .controller('search',function($scope,Search){
        $scope.$on("search",function(event,searchData){
            $('.loading').modal();
            setTimeout(function(){
                Search.doSearch(searchData).success(function(response){
                    $scope.searchResults=response;
                    var searched={
                        searchResults:response,
                        searchData:searchData
                    };
                    $('.loading').modal("hide");
                    $scope.$broadcast("searched",searched);
                    window.scrollTo(0,0);
                })
                .error(function(){
                    $scope.searchError="Cannot search at this time. Please try again later.";
                    $('.loading').modal("hide");
                    window.scrollTo(0,0);
                });
            },500);            
        });
        
    })
    .controller('search-form',function($scope,Search) {
        $scope.submitForm=function(){
            $scope.searchError="";
            $scope.searchResults=[];            
            var searchData={
                location:$scope.location,
                building:$scope.building,
                roomName:$scope.roomName,
                capacity:$scope.capacity,
                roomType:$scope.roomType,
                technology:$("#technology").multipleSelect("getSelects")
            };
            $scope.$emit("search",searchData);            
        };
        
        $scope.resetForm=function(){
            $scope.location="";
            $scope.buildings=[{buildingID:0,building:" - Select a Location to show more buildings - "}];
            $scope.building="";
            $scope.roomName="";
            $scope.capacity="";
            $scope.roomType="";
            $("#technology").multipleSelect("setSelects",[]);
            
            window.scrollTo(0,0);
        }
        
        $scope.$on("searched",function(event,data){
            $scope.searched=true;
        })

    })
    .controller('search-results',function($timeout,$scope,$http,$rootScope){
        $scope.$on("searched",function(event,data){
            if(!data || data.length==0){
                $scope.rooms=false;
                return;
            }
            $scope.searchData={};
            $scope.searchData.formData=data.searchData;
            $scope.searched=true;
            $scope.rooms=data.searchResults.rooms;                        
            $timeout(function(){
                $('#searchResultsTable').dataTable()
            },0);
            
        });
        $scope.showDetails=function(roomID){
            $scope.loadingDetails=true;
             $http.get("/rooms/"+roomID,{cache:true}).success(function(response){
                if(!response.room){
                    $rootScope.searchError="Room details are not available at this time."
                    $scope.loadingDetails=false;
                    return false;
                }
                $scope.room=response.room;
                $('.details').modal();
                $scope.loadingDetails=false;
            })
            .error(function(){
                $rootScope.searchError="Room details are not available at this time."
            });          
            
        };
        $scope.showFullImage=function(){
            $("#fullImage").modal();
        }
        $scope.showAdditionalImages=function(){
            $http.get("/room-images/"+$scope.room.roomID,true).success(function(response){
                if(!response.additionalImages){
                    $scope.searchResultsMsg="No Additional Images.";
                    return;
                }
                $scope.additionalImages=response.additionalImages;
                
            }).error(function(){
                $scope.searchResultsError="Cannot load any additional images at this time.";
            });
        }
    })
    .controller("details",function($scope){
        
    });