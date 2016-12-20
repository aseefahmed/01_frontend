angular.module('loginApp').controller('LoginController', function($scope, $http){
    $scope.loginFailed = false;
    $scope.doSignIn = function () {

        var data = $.param({
            email: $scope.email,
            password: $scope.password
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;',
            }
        };
        $http.post(app.host + 'process-login', data, config).success(function (result, status) {
            if(result == -1)
            {
                $scope.login_failed_alert = "Invalid username/password. Please try again."
            }
            else
            {
                window.location.href = '../#/production/buyers'
            }
        }).error(function (result, status) {

        });
    }
})

