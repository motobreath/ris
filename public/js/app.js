'use strict';

// Declare app level module which depends on filters, and services
angular.module('ris', [
  'ngRoute',
  'ngAnimate',
  'ngResource',
  'ris.controllers',
  'ris.services',
  'ris.directives',
  'ris.filters'
]).
config(['$routeProvider', function($routeProvider) {
  $routeProvider.when('/search', {templateUrl: 'partials/search.html', controller: 'search'});
  $routeProvider.when('/search-results', {templateUrl: 'partials/search-results.html', controller: 'search'});
  $routeProvider.otherwise({redirectTo: '/search'});
}])
.run(function($rootScope){
    
    
});
