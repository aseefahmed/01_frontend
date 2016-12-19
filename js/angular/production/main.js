myApp = angular.module('myApp', ['ngRoute', 'angularUtils.directives.dirPagination']);

myApp.config(function($routeProvider, $locationProvider){
    $routeProvider.when('/test', {
        template: "<h2>aseef</h2>"
    })
        .when('/production/buyers', {
            templateUrl: 'views/production/buyers/index.html',
            controller: 'BuyerController'
        })
        .when('/production/styles', {
            templateUrl: 'views/production/styles/index.html',
            controller: 'StyleController'
        });


});