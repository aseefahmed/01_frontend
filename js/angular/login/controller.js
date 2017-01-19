angular.module('loginApp').controller('LoginController', function($scope, $http, $window){
    $scope.loginFailed = false;
    $scope.login_failed_alert = "";
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
        $('#loading_gif_register').css('display', 'inline');
        var data = $.param({
            first_name: $scope.employee.first_name,
            last_name: $scope.employee.last_name,
            email_address: $scope.employee.email_address,
            pass: $scope.employee.pass
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };console.log(data)
        $scope.registration_failed_alert = 0;
        $http.post(app.host + 'register', data, config).success(function (result, status) {
            $('#loading_gif_register').css('display', 'none');
            if(result == 1)
            {
                $scope.registration_failed_alert = 1;
            }
            else if(result == 2)
            {
                $scope.employee = {};
                $scope.registration_failed_alert = 2;
            }
        }).error(function (result, status) {
            $('#loading_gif_register').css('display', 'none');
            $scope.registration_failed_alert = -1;
        });
    }
    $scope.doSignIn = function () {
        $('#loading_gif').css('display', 'inline');
        var data = $.param({
            email: $scope.email,
            password: $scope.password
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;',
                "Access-Control-Allow-Origin": "http://doddy.aseefahmed.net/",
                "Access-Control-Allow-Headers": "Cache-Control, Pragma, Origin, Authorization, Content-Type, X-Requested-With"
            }
        };
        $http.post(app.host + 'process-login', data, config).success(function (result, status) {
            $('#loading_gif').css('display', 'none');
            if(result == -1)
            {
                $scope.login_failed_alert = "Invalid username/password. Please try again."
            }
            else if(result == -2)
            {
                $scope.login_failed_alert = "Your account has not been activated yet. Please contact your administrator to activate your account."
            }
            else
            {
                sessionStorage.setItem('loginUser', JSON.stringify(result));
                console.log(result)
                $window.location.href = '../#/buying/orders';
            }
        }).error(function (result, status) {
            $('#loading_gif').css('display', 'none');
            $scope.login_failed_alert = "Internal server error occurred. Please contact the administrator."
        });;
    }
})

