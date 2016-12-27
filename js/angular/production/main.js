myApp = angular.module('myApp', ['ngRoute', 'angularUtils.directives.dirPagination', 'ngFileUpload']);

myApp.config(function($routeProvider, $locationProvider){
    $routeProvider.when('/production/buyers', {
        templateUrl: 'views/production/buyers/index.html',
        controller: 'BuyerController'
    })
        .when('/production/orders', {
            templateUrl: 'views/production/orders/index.html',
            controller: 'OrderController'
        })
        .when('/production/styles', {
            templateUrl: 'views/production/styles/index.html',
            controller: 'StyleController'
        })
        .when('/production/buyer/:buyer_id', {
            templateUrl: 'views/production/buyers/show.html',
            controller: 'BuyerController'
        })
        .when('/production/order/:order_id', {
            templateUrl: 'views/production/orders/show.html',
            controller: 'OrderController'
        })
        .when('/production/style/:style_id', {
            templateUrl: 'views/production/styles/show.html',
            controller: 'StyleController'
        })
        .when('/dashboard', {
            templateUrl: 'views/dashboard/index.html',
            controller: 'DashboardController'
        })
        .when('/production/requisitions/generate', {
            templateUrl: 'views/production/requisitions/generate.html',
            controller: 'RequisitionController'
        })
        .when('/production/requisitions/id/:requisition_id', {
            templateUrl: 'views/production/requisitions/details.html',
            controller: 'AllRequisitionController'
        })
        .when('/production/reports/orders', {
            templateUrl: 'views/production/reports/orders.html',
            controller: 'OrderController'
        })
        .when('/production/reports/saved', {
            templateUrl: 'views/production/reports/saved.html',
            controller: 'OrderController'
        })
        .when('/production/requisitions/recieved', {
            templateUrl: 'views/production/requisitions/recieved.html',
            controller: 'AllRequisitionController'
        })
        .when('/production/requisitions/sent', {
            templateUrl: 'views/production/requisitions/sent.html',
            controller: 'AllRequisitionController'
        });


});

loginApp = angular.module('loginApp', ['ngRoute']);

