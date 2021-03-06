angular.module('myApp').controller('BuyingOrderController', function($scope, $http, $routeParams, $route, Upload){
    $scope.loginUser = JSON.parse(sessionStorage.getItem('loginUser'));
    $scope.host = app.host;
    $scope.buying_orders = function () {
        $scope.page_title = 'Orders List';
        $scope.num_of_items_arr = [{id: 5, value: 5},{id: 10, value: 10},{id: 20, value: 20},{id: 50, value: 50},{id: 100, value: 100}];
        $http.get(app.host + 'buying/order/fetchOrdersList/'+$scope.loginUser.id+'/'+$scope.loginUser.emp_role).then(function (response) {
            console.log('ddd');
            console.log(response.data)
            $scope.num_of_items = 10;
            $scope.orders = response.data.orders;
            $scope.days_of_14_days = response.data.data_of_14_days_ago;
            $scope.reverse = false;
        });
        $http.get(app.host + '/production/buyer/fetchBuyersList').then(function (response) {
            $scope.buyers = response.data;
            console.log($scope.buyers)
        });

    };
    $scope.options = [
        {
            id: 'Yes',
            val: 'Yes'
        },
        {
            id: 'No',
            val: 'No'
        }
    ];
    $scope.color_status = [
        {
            id: '0',
            val: 'Pending'
        },
        {
            id: '1',
            val: 'Partially Completed'
        },
        {
            id: '2',
            val: 'Completed'
        }
    ];

    $scope.color_types = [
        {
            id: '1',
            val: 'Solid'
        },
        {
            id: '2',
            val: 'Twisted'
        }
    ];
    $scope.attach_files = function(field, id, myfile, table_name)
    {
        Upload.upload({
            url: app.host + 'buying/orders/uploadFiles',
            data: {
                id: id,
                field: field,
                table_name: table_name,
                file: myfile.image
            },
        }).then(function (response) {console.log(response)
            $('#attach-files-modal').modal('toggle');
            $http.get(app.host + 'buying/order/fetchOrderDetails/'+id).then(function (response) {
            $scope.order_details = response.data;

        });
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
    $scope.fetchOrdersStats = function(){
        $http.get(app.host + 'buying/orders/fetchOrdersStats').then(function (response) {
            $scope.no_of_orders_handedover = response.data.no_of_orders_handedover;
            $scope.no_of_po_recieved = response.data.no_of_po_recieved;
            $scope.no_of_orders_inspected = response.data.no_of_orders_inspected;
            $scope.new_orders = response.data.new_orders;
            $scope.handedover_this_month = response.data.handedover_this_month;
            $scope.no_of_po_recieved_this_month = response.data.no_of_po_recieved_this_month;
            console.log(response)
        });
    }
    $scope.buyersList = function()
    {
        $http.get(app.host + '/production/buyer/fetchBuyersList').then(function (response) {
            $scope.buyers = response.data;console.log($scope.buyers)
        });
    }
    $scope.validateBuyingOrderEditForm = function(data, minlength, maxlength, message, role, authorized_person) {
        if(role == 1 || role == 2 || ($scope.loginUser.id == authorized_person))
        {
            
            if(data.length  < minlength || data.length > maxlength)
                return message;
        }
        else
        {
            return "You are not authorized to edit this information."
        }

    };

    $scope.edit_buying_order_confirmed = function(field, id, value, data_type = null, table_name = null) {

        if(data_type == "date_data")
        {
            var d = new Date(value);
            d = $.datepicker.formatDate('yy-mm-dd', d);
            value = d;
        }

        if(!table_name)
        {
            table_name = 'buying_orders';    
        }

        if(value.length == 0)
            value='-';

        $http.get(app.host + 'buying/order/update/'+$scope.loginUser.id+'/'+field+'/'+id+'/'+value+'/'+table_name).then(function(response){
            $('.top-right').notify({
                type: 'success',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>The operation was successful.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            $scope.buyer = response.data;
            $http.get(app.host + 'buying/order/fetchOrderDetails/'+id).then(function(response){
                $scope.buyer = response.data;
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
        $scope.page_title = 'Order Details';
        $scope.host = app.host;
        $http.get(app.host + 'buying/order/fetchOrderDetails/'+$routeParams.order_id).then(function (response) {
            $scope.order_details = response.data;
            console.log('ass');
            console.log(response);

        });

    };
    $scope.add_buying_order_color = function(color, type, order_id){
        var data = $.param({
            color_name: color,
            type: type,
            order_id: order_id
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        $http.get(app.host + 'buying/order/addColor/'+color+'/'+type+'/'+order_id).success(function (result, status) {console.log(result)
            $('#add-color-modal').modal('toggle');
            $http.get(app.host + 'buying/order/fetchOrderDetails/'+$routeParams.order_id).then(function (response) {
                $scope.order_details = response.data;

            });
            $('.top-right').notify({
                type: 'success',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>Operation was successful.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
        }).error(function (result, status) {
            $('#add-color-modal').modal('toggle');
            $('.top-right').notify({
                type: 'danger',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>Operation was unsuccessful. </strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
        });
    };
    $scope.add_buying_order = function(form, myfile=null){   console.log(myfile)
        if(!myfile)
        {
            image = '';
        }
        else
        {
            image = myfile.image;
        }
        Upload.upload({
            url: app.host + 'buying/orders/store',
            data: {
                user_id: $scope.loginUser.id,
                style: $scope.order.style_id,
                ref: $scope.order.ref,
                pi_date: $scope.order.pi_date,
                handover_date: $scope.order.handover_date,
                Gauge: $scope.order.order_gg,
                yarn_ref_details: $scope.order.yarn_ref,
                customer: $scope.order.customer,
                colors: $scope.order.color,
                qty: $scope.order.order_qty,
                sizing: $scope.order.sizing,
                main_label: $scope.order.main_label,
                hang_tag: $scope.order.hang_tag,
                colors: $scope.order.colors,
                customer: $scope.order.customer,
                contract_weight: $scope.order.contract_weight,
                sketch: image
            },
        }).then(function (response) {
            $('#add-order-modal').modal('toggle');
            $http.get(app.host + 'buying/order/fetchOrdersList/'+$scope.loginUser.id+'/'+$scope.loginUser.emp_role).then(function (response) {
                $scope.num_of_items = 10;
                $scope.orders = response.data.orders;
                $scope.reverse = false;
                $scope.order = {};
                form.$setPristine();
            });
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
    };
})