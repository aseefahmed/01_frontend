
angular.module('myApp').controller('EmployeeController', function($scope, $http, $route, $routeParams, Upload) {
    $scope.loginUser = JSON.parse(sessionStorage.getItem('loginUser'));
    if($routeParams.employee_id){
        $scope.employee_id = $routeParams.employee_id;
    }
    $scope.reloadData = function(){
        $route.reload();
    };
    $scope.host = app.host;
    $scope.changeUserFlag = function(user_id, flag, loginUser){
        $http.get(app.host + 'employees/changeUserFlag/'+flag+"/"+user_id+"/"+loginUser).then(function (response) {
            $http.get(app.host + 'employees/fetchEmployeesList').then(function (response) {
            $scope.num_of_items = 10;
            $scope.users = response.data;
            $scope.data_found = $scope.users.length;
            $scope.reverse = false;
        });
        });
    };
    $scope.attach_files = function(field, id, myfile, table_name)
    {
        Upload.upload({
            url: app.host + 'employee/uploadFiles',
            data: {
                id: id,
                field: field,
                table_name: table_name,
                file: myfile.image
            },
        }).then(function (response) {console.log(response)
            $('#attach-files-modal').modal('toggle');
            $http.get(app.host + 'employees/fetchEmployeeDetails/'+id).then(function(response){
                console.log(response)
                $scope.employee = response.data.users;
            })
            $('.top-right').notify({
                type: 'success',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>You have successfully add an order.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            $scope.order = {};

        }, function (response) {console.log(response)
            $('#add-order-modal').modal('toggle');
            $('.top-right').notify({
                type: 'danger',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>The operation was unsuccessful.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
        });
    }
    $scope.init_employeelist = function () {
        $scope.page_title = 'Employees List';
        $scope.num_of_items_arr = [{id: 5, value: 5},{id: 10, value: 10},{id: 20, value: 20},{id: 50, value: 50},{id: 100, value: 100}];
        $http.get(app.host + 'employees/fetchEmployeesList').then(function (response) {
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
    $scope.remove_employee = function(id, name, action){
        if(action == 'single_delete')
        {
            $scope.employee_name = name;
            $scope.employee_id = id;
            $scope.status = 'single_delete';
            $scope.modal_msg = "Do you really want to delete the employee "+$scope.employee_name+".";
            $('#remove-employee-modal').modal('toggle');
        }
        else if(action == 'all')
        {
            if($scope.users.length == 0)
            {
                $('#removal-warning-modal').modal('toggle');
            }
            else
            {
                $scope.employee_id = 0;
                $scope.status = 'all';
                var arr = [];
                $('.select_row').each(function() {
                    arr.push(this.value);
                });
                $scope.employee_id = arr;
                $scope.modal_msg = "Do you really want to delete all employees";
                $('#remove-employee-modal').modal('toggle');
            }
        }
        else if(action == 'selected')
        {
            var arr = [];
            $scope.status = 'selected';
            $('.select_row:checked').each(function() {
                arr.push(this.value);
            });
            $scope.modal_msg = "Do you really want to delete selected employees";
            if(arr.length == 0)
            {
                $('#removal-warning-modal').modal('toggle');
            }
            else
            {
                $scope.employee_id = arr;
                $('#remove-employee-modal').modal('toggle');
            }
        }
    };
    $scope.remove_employee_confirmed = function(id, page, action){
        $scope.employee_name = null;
        var data = $.param({
            user_id: $scope.loginUser.id,
            id: id,
            action: action
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        $http.post(app.host + 'employee/delete', data, config).success(function (result, status) {
            $('#remove-employee-modal').modal('toggle');
            $('.top-right').notify({
                type: 'success',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>Operation was successful.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            if(page == 'show_page')
            {
                window.location.href = '#/hrm/employees';
            }
            else
            {
                $http.get(app.host + 'employees/fetchEmployeesList').then(function (response) {
                    $scope.num_of_items = 10;
                    $scope.users = response.data;
                    $scope.reverse = false;
                })
            }
        }).error(function (result, status) {
            $('#remove-employee-modal').modal('toggle');
            $('.top-right').notify({
                type: 'danger',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>Operation was unsuccessful. </strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
        });

    };
    $scope.roles = [
        {
            id: '1',
            val: 'Admin'
        },
        {
            id: '2',
            val: 'Director'
        },
        {
            id: '3',
            val: 'HR'
        },
        {
            id: '9',
            val: 'Merchandiser'
        },
        {
            id: '10',
            val: 'Visitor'
        },
    ];
    $scope.validateEmpoyeeEditForm = function(data, minlength, maxlength, message, role, authorized_peron) {
       if(role == 1 || role == 2 || role == 3 || ($scope.loginUser.id == authorized_peron))
        {
            if(data.length  < minlength || data.length > maxlength)
                return message;

        }
        else
        {
            return "You are not authorized to edit this information."
        }

    };
    $scope.changePass = function(user_id, pass, myform){
        $scope.employee.password = null;
        $scope.employee.retype_password = null;
        myform.$setPristine();
        var data = $.param({
            password: pass,
            user_id: user_id,
            logged_user_id: $scope.loginUser.id,
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        $http.post(app.host + 'employees/changePass', data, config).success(function (result, status) {console.log(result)
            $('.top-right').notify({
                type: 'success',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>Operation was successful.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
        }).error(function (result, status) {
            $('.top-right').notify({
                type: 'danger',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>Operation was unsuccessful. </strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
        });
    };
    $scope.edit_employees_info_confirmed = function(field, id, value, data_type = null, table_name = null) {

        if(data_type == "date_data")
        {
            var d = new Date(value);
            d = $.datepicker.formatDate('yy-mm-dd', d);
            value = d;
        }

        if(table_name)
        {
            table_name = table_name;
        }
        else
        {
            table_name = 'users';
        }

        if(value.length == 0)
            value='-';

        $http.get(app.host + 'employees/updateEmployeesInfo/'+field+'/'+id+'/'+value+'/'+table_name+'/'+$scope.loginUser.id).then(function(response){
            $('.top-right').notify({
                type: 'success',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>The operation was successful.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            $http.get(app.host + 'employees/fetchEmployeeDetails/'+id).then(function(response){
            console.log(response)
            $scope.employee = response.data.users;
        })
        }, function(response){
            $('.top-right').notify({
                type: 'danger',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>The operation was unsuccessful.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
        })
    }
    $scope.opened = {};
    $scope.open = function($event, elementOpened) {
        $event.preventDefault();
        $event.stopPropagation();

        $scope.opened[elementOpened] = !$scope.opened[elementOpened];
    };
    $scope.init = function(){
        $scope.page_title = 'Employee Details';
        
        if($scope.loginUser.id == $scope.employee_id || $scope.loginUser.emp_role == 1)
        {
            $('#ajax_loading').css('display', 'block');
            $http.get(app.host + 'employees/fetchEmployeeDetails/'+$scope.employee_id).then(function(response){
                console.log(response)
                $scope.employee = response.data.users;
            })
        }
        else
        {
            window.location.href = '#/error/unauthorized';
        }
        
    };
    /*$scope.edit_employee = function (id, edit_item, field, field_type, is_required, min_length, max_length, pattern, error_text) {

        user_id: $scope.loginUser.id,
        $scope.editable_item = edit_item;
        $scope.employee_id = id;
        $scope.field = field;
        $scope.field_type = field_type;
        $scope.is_required = is_required;
        $scope.min_length = min_length;
        $scope.max_length = max_length;
        $scope.pattern = pattern;
        $scope.error_text = error_text;
        $scope.type = null;
        $('#edit-employee-modal').modal('toggle');
    };*/
    $scope.validateEditForm = function(data, minlength, maxlength, message, role) {
        if(role != 1)
        {
            return "You are not authorized to edit this information."
        }
        else
        {
            if(data.length  < minlength || data.length > maxlength)
                return message;
        }

    };
    $scope.edit_employee_confirmed = function (field, id, value) {
        if(value.length == 0)
            value='-';
        console.log($scope.type)

        $http.get(app.host + 'production/employee/update/'+$scope.loginUser.id+'/'+field+'/'+id+'/'+value).then(function(response){
            $('.top-right').notify({
                type: 'success',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>The operation was successful.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            $scope.employee = response.data;
            $http.get(app.host + 'employees/fetchEmployeesList'+id).then(function(response){
                $scope.employee = response.data;
            })
        }, function(response){
            $('.top-right').notify({
                type: 'danger',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>The operation was unsuccessful.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
        })
    }
    $scope.add_employee = function(form){
        Upload.upload({
            url: app.host + 'employees/store',
            data: {
                user_id: $scope.loginUser.id,
                first_name: $scope.employee.first_name,
                last_name: $scope.employee.last_name,
                emp_role: $scope.employee.emp_role,
                email: $scope.employee.email,
                password: $scope.employee.password
            },
        }).then(function (response) {
            $('#add-employee-modal').modal('toggle');
            $('.top-right').notify({
                type: 'success',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>You have successfully add a employee.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            $scope.employee = {};
            form.$setPristine();
            $http.get(app.host + 'employees/fetchEmployeesList').then(function (response) {
                $scope.num_of_items = 10;
                $scope.users = response.data;
                $scope.reverse = false;
            })
        }, function (response) {
            $('#add-employee-modal').modal('toggle');
            $('.top-right').notify({
                type: 'danger',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>The operation was unsuccessful.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            $scope.employee_name = null;
        });
    };
})
