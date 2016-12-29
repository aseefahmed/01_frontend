angular.module('loginApp').controller('LoginController', function($scope, $http, $window){
    $scope.loginFailed = false;
    $scope.email = 'aseefahmed@gmail.com';
    $scope.password = 'aseefahmed';
    $scope.registration_failed_alert = 0;
    $scope.switchToLoginPanel = function() {
        $('#loginPanel').addClass('active');
        $('#registerPanel').removeClass('active');
    }
    $scope.switchToRegisterPanel = function() {
        $('#loginPanel').removeClass('active');
        $('#registerPanel').addClass('active');
    }
    $scope.registerUser = function () {
        var data = $.param({
            first_name: $scope.first_name,
            last_name: $scope.last_name,
            email_address: $scope.email_address,
            pass: $scope.pass
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };console.log(data)
        $scope.registration_failed_alert = 0;
        $('#ajax_loading').css('display', 'block');
        $http.post(app.host + 'register', data, config).success(function (result, status) {
            $('#ajax_loading').css('display', 'none');
            if(result == 1)
            {
                $scope.registration_failed_alert = 1;
            }
            else if(result == 2)
            {
                $scope.registration_failed_alert = 2;
            }
        }).error(function (result, status) {
            $('#ajax_loading').css('display', 'none');
            $scope.registration_failed_alert = -1;
        });
    }
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

