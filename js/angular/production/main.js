myApp = angular.module('myApp', ['ngRoute', 'angularUtils.directives.dirPagination']);

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
        .when('production/requisitions/recieved', {
            templateUrl: 'views/production/requisitions/recieved.html',
            controller: 'AllRequisitionController'
        });


});

loginApp = angular.module('loginApp', ['ngRoute']);

