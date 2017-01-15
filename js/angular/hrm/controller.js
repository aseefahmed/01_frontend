angular.module('myApp').controller('EmployeesController', function($scope, $http, $window){
    $scope.loginUser = JSON.parse(sessionStorage.getItem('loginUser'));

    $scope.init_employeelist = function () {
        $scope.page_title = 'Employees List';
        $scope.num_of_items_arr = [{id: 5, value: 5},{id: 10, value: 10},{id: 20, value: 20},{id: 50, value: 50},{id: 100, value: 100}];
        $http.get(app.host + 'hrm/employees/fetchEmployeesList').then(function (response) {
            $scope.num_of_items = 10;
            $scope.users = response.data;
            console.log('dddd')
            console.log($scope.users)
            $scope.data_found = $scope.users.length;
            $scope.reverse = false;
        });
        $scope.sortKey = 'first_name';
        $scope.sort = function (header) {
            $scope.sortKey = header;
            $scope.reverse = !$scope.reverse;
        };
    }

    $scope.init_add_emp = function () {
        $scope.page_title = 'Add Employee';

    }

});
