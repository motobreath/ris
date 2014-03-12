angular.module('ris.services',[])
.service("Search",["$http",function($http){
        return {
            doSearch:function(searchData){
                return $http.get("/search" + this.buildQueryString(searchData))
            },
            buildQueryString:function(searchData){
                var queryString="?";
                angular.forEach(searchData,function(value,key){
                    if(typeof(value)==="undefined" || value==""){
                        delete searchData[key];
                    }
                })
                if(searchData.technology && searchData.technology.length===0){
                    delete searchData["technology"];
                }
                angular.forEach(searchData,function(value,key){
                    queryString+=key+"="+value+"&";
                })
                
                if(queryString=="?"){
                    queryString="";
                }
                queryString = queryString.substring(0, queryString.length - 1);
                
                return queryString;
            }
            
        };
}])
.service("Room",["$http",function($http){
        return {
            getRoom:function(roomID){
               return $http.get("/room"+roomID,true); 
            },
            fetchAll:function(){
                
            }
        };
}]);