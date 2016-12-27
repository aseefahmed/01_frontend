angular.module('myApp').controller('OrderController', function($scope, $http, $route, $routeParams) {
    $scope.loginUser = JSON.parse(sessionStorage.getItem('loginUser'));
    if($routeParams.order_id){
        $scope.order_id = $routeParams.order_id;
    }
    $scope.page_title = 'Orders List';
    $scope.num_of_items_arr = [{id: 5, value: 5},{id: 10, value: 10},{id: 20, value: 20},{id: 50, value: 50},{id: 100, value: 100}];
    $scope.reloadData = function(){
        $route.reload();
    };
    $http.get(app.host + '/production/order/fetchOrdersList').then(function (response) {
        $scope.num_of_items = 10;
        $scope.orders = response.data;
        $scope.data_found = $scope.orders.length;
        $scope.reverse = false;
    });
    $scope.sortKey = 'order_name';
    $scope.sort = function (header) {
        $scope.sortKey = header;
        $scope.reverse = !$scope.reverse;
    };
    $scope.remove_order = function(id, name, action){
        if(action == 'single_delete')
        {
            $scope.order_name = name;
            $scope.order_id = id;
            $scope.status = 'single_delete';
            $scope.modal_msg = "Do you really want to delete the order "+$scope.order_name+".";
            $('#remove-order-modal').modal('toggle');
        }
        else if(action == 'all')
        {
            if($scope.orders.length == 0)
            {
                $('#removal-warning-modal').modal('toggle');
            }
            else
            {
                $scope.order_id = 0;
                $scope.status = 'all';
                $scope.modal_msg = "Do you really want to delete all orders";
                $('#remove-order-modal').modal('toggle');
            }
        }
        else if(action == 'selected')
        {
            var arr = [];
            $scope.status = 'selected';
            $('.select_row:checked').each(function() {
                console.log(this.value)
                arr.push(this.value);
            });
            $scope.modal_msg = "Do you really want to delete selected orders";
            if(arr.length == 0)
            {
                $('#removal-warning-modal').modal('toggle');
            }
            else
            {
                $scope.order_id = arr;
                $('#remove-order-modal').modal('toggle');
            }
        }
    };
    $scope.remove_order_confirmed = function(id, page, action){
        $scope.order_name = null;
        var data = $.param({
            id: id,
            action: action
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        $http.post(app.host + 'production/order/delete', data, config).success(function (result, status) {
            console.log(result);
            $('#remove-order-modal').modal('toggle');
            $('.top-right').notify({
                type: 'success',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>Operation was successful.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            if(page == 'show_page')
            {
                window.location.href = '#/production/orders';
            }
            else
            {
                $http.get(app.host + 'production/order/fetchOrdersList').then(function (response) {
                    $scope.num_of_items = 10;
                    $scope.orders = response.data;
                    $scope.reverse = false;
                })
            }
        }).error(function (result, status) {
            $('#remove-order-modal').modal('toggle');
            $('.top-right').notify({
                type: 'danger',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>Operation was unsuccessful. </strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
        });

    };
    $scope.init = function(id){
        $scope.page_title = 'Order Details';
        $http.get(app.host + 'production/orders/fetchOrderDetails/'+id).then(function(response){
            console.log(response)
            $scope.order = response.data;
        })
    };
    $scope.edit_order = function (id, edit_item, field, field_type, is_required, min_length, max_length, pattern, error_text) {
        $scope.editable_item = edit_item;
        $scope.order_id = id;
        $scope.field = field;
        $scope.field_type = field_type;
        $scope.is_required = is_required;
        $scope.min_length = min_length;
        $scope.max_length = max_length;
        $scope.pattern = pattern;
        $scope.error_text = error_text;
        $scope.type = null;
        $('#edit-order-modal').modal('toggle');
    }
    $scope.edit_order_confirmed = function (id) {
        $('#edit-order-modal').modal('toggle');
        if($scope.type == null)
        {
            $scope.type = '--';
        }
        $http.get(app.host + 'production/order/update/'+$scope.field+'/'+id+'/'+$scope.type).then(function(response){
            $('.top-right').notify({
                type: 'success',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>You have successfully updated the information.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            $scope.order = response.data;
            $http.get(app.host + 'production/orders/fetchOrderDetails/'+id).then(function(response){
                $scope.order = response.data;
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
    $scope.add_order = function(){
        var data = $.param({
            user_id: $scope.loginUser.id,
            order_name: $scope.order_name,
            postal_address: $scope.postal_address,
            contact_person: $scope.contact_person,
            email_address: $scope.email_address,
            contact_number: $scope.contact_number,
            website: $scope.website,
            order_image: $scope.order_image
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        $http.post(app.host + 'production/orders', data, config).success(function (result, status) {
            console.log()
            $('#add-order-modal').modal('toggle');
            $('.top-right').notify({
                type: 'success',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>You have successfully add a order.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            $scope.order_name = null;
            $http.get(app.host + 'production/order/fetchOrdersList').then(function (response) {
                $scope.num_of_items = 10;
                $scope.orders = response.data;
                $scope.reverse = false;
            })
        }).error(function (result, status) {
            $('#add-order-modal').modal('toggle');
            $('.top-right').notify({
                type: 'danger',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>The operation was unsuccessful.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            $scope.order_name = null;
        });
    };
})
