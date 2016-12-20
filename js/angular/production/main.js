myApp = angular.module('myApp', ['ngRoute', 'angularUtils.directives.dirPagination']);

myApp.config(function($routeProvider, $locationProvider){
    $routeProvider.when('/production/buyers', {
        templateUrl: 'views/production/buyers/index.html',
        controller: 'BuyerController'
    })
        .when('/production/styles', {
            templateUrl: 'views/production/styles/index.html',
            controller: 'StyleController'
        });


});

loginApp = angular.module('loginApp', ['ngRoute']);

