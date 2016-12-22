angular.module('loginApp').controller('LoginController', function($scope, $http, $window){
    $scope.loginFailed = false;
    $scope.doSignIn = function () {

        var data = $.param({
            email: $scope.email,
            password: $scope.password
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;',
                "Access-Control-Allow-Origin": "*",
                "Access-Control-Allow-Headers": "Cache-Control, Pragma, Origin, Authorization, Content-Type, X-Requested-With"
            }
        };
        $http.post(app.host + 'process-login', data, config).success(function (result, status) {
            console.log(result)
            if(result == -1)
            {
                $scope.login_failed_alert = "Invalid username/password. Please try again."
            }
            else
            {
                sessionStorage.setItem('loginUser', JSON.stringify(result));
                console.log(result)
                $window.location.href = '../#/dashboard';
            }
        }).error(function (result, status) {
            $scope.login_failed_alert = "Internal server error occurred. Please contact the administrator."
        });;
    }
})

