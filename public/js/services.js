angular.module('ris.services',[])
.service("Search",["$http",function($http){ 
        return {
            doSearch:function(searchData){
                return $http.get("/search" + this.buildQueryString(searchData))
            },
            buildQueryString:function(searchData){
                var queryString="?";
                angular.forEach(searchData,function(value,key){
                    if(typeof(value)==="undefined"){
                        delete searchData[key];
                    }
                })
                if(searchData.technology.length===0){
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
.service("Locations",["$http",function($http){
        return {
            get:function(){
                return $http.get("/locations");
            }
        }
}])
.service("Buildings",["$http",function($http){
        return {
            fetchAll:function(){
                return $http.get("/buildings");
            },
            getByLocation:function(location){
                return $http.get("/buildings?location="+location);
            }
        }
}]);