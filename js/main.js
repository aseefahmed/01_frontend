myApp = angular.module('myApp', ['ngRoute', 'angularUtils.directives.dirPagination', 'ngFileUpload', 'ngIdle', 'xeditable']);
console.log('----')

myApp.run(function(editableOptions) {
    editableOptions.theme = 'bs3'; // bootstrap3 theme. Can be also 'bs2', 'default'
});

myApp.config(function($routeProvider, $locationProvider, KeepaliveProvider, IdleProvider){
    IdleProvider.idle(5);
    IdleProvider.timeout(5);
    KeepaliveProvider.interval(10);

    $routeProvider.when('/production/buyers', {
        templateUrl: 'views/production/buyers/index.html',
        controller: 'BuyerController'
    })
        .when('/production/suppliers', {
            templateUrl: 'views/production/suppliers/index.html',
            controller: 'SupplierController'
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
        .when('/production/supplier/:supplier_id', {
            templateUrl: 'views/production/suppliers/show.html',
            controller: 'SupplierController'
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
        })
        .when('/buying/orders', {
            templateUrl: 'views/buying/orders/index.html',
            controller: 'BuyingOrderController'
        })
        .when('/hrm/employees', {
            templateUrl: 'views/hrm/employees/index.html',
            controller: 'EmployeeController'
        })
        .when('/hrm/employee/:employee_id', {
            templateUrl: 'views/hrm/employees/show.html',
            controller: 'EmployeeController'
        })
        .when('/hrm/employees/add', {
            templateUrl: 'views/hrm/employees/add.html',
            controller: 'EmployeeController'
        });



});

loginApp = angular.module('loginApp', ['ngRoute']);

