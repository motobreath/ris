'use strict';

// Declare app level module which depends on filters, and services
angular.module('ris', [
  'ngRoute',
  'ngAnimate',
  'ngResource',
  'ris.controllers',
  'ris.services',
  'ris.directives'
]).
config(['$routeProvider', function($routeProvider) {
  $routeProvider.when('/search', {templateUrl: 'partials/search.html', controller: 'search'});
  $routeProvider.otherwise({redirectTo: '/search'});
}])
.run(function($rootScope){
    
    
});
