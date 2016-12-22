angular.module('myApp').controller('DashboardController', function($scope, $http, $window){
    $scope.loginUser = JSON.parse(sessionStorage.getItem('loginUser'));
    $scope.goToDashboard = function () {
        $window.location.href = '#/dashboard';
    }

});

angular.module('myApp').controller('MenuController', function($scope, $http, $location){
    $scope.location = $location;
});

angular.module('myApp').controller('BuyerController', function($scope, $http, $route, $routeParams) {
    $scope.loginUser = JSON.parse(sessionStorage.getItem('loginUser'));
    if($routeParams.buyer_id){
        $scope.buyer_id = $routeParams.buyer_id;
    }
    $scope.page_title = 'Buyers List';
    $scope.num_of_items_arr = [{id: 5, value: 5},{id: 10, value: 10},{id: 20, value: 20},{id: 50, value: 50},{id: 100, value: 100}];
    $scope.reloadData = function(){
        $route.reload();
    };
    $http.get(app.host + '/production/buyer/fetchBuyersList').then(function (response) {
        $scope.num_of_items = 10;
        $scope.buyers = response.data;
        $scope.data_found = $scope.buyers.length;
        $scope.reverse = false;
    });
    $scope.sortKey = 'buyer_name';
    $scope.sort = function (header) {
        $scope.sortKey = header;
        $scope.reverse = !$scope.reverse;
    };
    $scope.remove_buyer = function(id, name, action){
        if(action == 'single_delete')
        {
            $scope.buyer_name = name;
            $scope.buyer_id = id;
            $scope.status = 'single_delete';
            $scope.modal_msg = "Do you really want to delete the buyer "+$scope.buyer_name+".";
            $('#remove-buyer-modal').modal('toggle');
        }
        else if(action == 'all')
        {
            if($scope.buyers.length == 0)
            {
                $('#removal-warning-modal').modal('toggle');
            }
            else
            {
                $scope.buyer_id = 0;
                $scope.status = 'all';
                $scope.modal_msg = "Do you really want to delete all buyers";
                $('#remove-buyer-modal').modal('toggle');
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
            $scope.modal_msg = "Do you really want to delete selected buyers";
            if(arr.length == 0)
            {
                $('#removal-warning-modal').modal('toggle');
            }
            else
            {
                $scope.buyer_id = arr;
                $('#remove-buyer-modal').modal('toggle');
            }
        }
    };
    $scope.remove_buyer_confirmed = function(id, page, action){
        $scope.buyer_name = null;
        var data = $.param({
            id: id,
            action: action
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        $http.post(app.host + 'production/buyer/delete', data, config).success(function (result, status) {
            console.log(result);
            $('#remove-buyer-modal').modal('toggle');
            $('.top-right').notify({
                type: 'success',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>Operation was successful.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            if(page == 'show_page')
            {
                window.location.href = '#/production/buyers';
            }
            else
            {
                $http.get(app.host + 'production/buyer/fetchBuyersList').then(function (response) {
                    $scope.num_of_items = 10;
                    $scope.buyers = response.data;
                    $scope.reverse = false;
                })
            }
        }).error(function (result, status) {
            $('#remove-buyer-modal').modal('toggle');
            $('.top-right').notify({
                type: 'danger',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>Operation was unsuccessful. </strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
        });

    };
    $scope.init = function(id){
        $scope.page_title = 'Buyer Details';
        $http.get(app.host + 'production/buyers/fetchBuyerDetails/'+id).then(function(response){
            console.log(response)
            $scope.buyer = response.data;
        })
    };
    $scope.edit_buyer = function (id, edit_item, field, field_type, is_required, min_length, max_length, pattern, error_text) {
        $scope.editable_item = edit_item;
        $scope.buyer_id = id;
        $scope.field = field;
        $scope.field_type = field_type;
        $scope.is_required = is_required;
        $scope.min_length = min_length;
        $scope.max_length = max_length;
        $scope.pattern = pattern;
        $scope.error_text = error_text;
        $scope.type = null;
        $('#edit-buyer-modal').modal('toggle');
    }
    $scope.edit_buyer_confirmed = function (id) {
        $('#edit-buyer-modal').modal('toggle');
        if($scope.type == null)
        {
            $scope.type = '--';
        }
        $http.get(app.host + 'production/buyer/update/'+$scope.field+'/'+id+'/'+$scope.type).then(function(response){
            $('.top-right').notify({
                type: 'success',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>You have successfully updated the information.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            $scope.buyer = response.data;
            $http.get(app.host + 'production/buyers/fetchBuyerDetails/'+id).then(function(response){
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
    $scope.add_buyer = function(){
        var data = $.param({
            user_id: $scope.loginUser.id,
            buyer_name: $scope.buyer_name,
            postal_address: $scope.postal_address,
            contact_person: $scope.contact_person,
            email_address: $scope.email_address,
            contact_number: $scope.contact_number,
            website: $scope.website,
            buyer_image: $scope.buyer_image
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        $http.post(app.host + 'production/buyers', data, config).success(function (result, status) {
            console.log()
            $('#add-buyer-modal').modal('toggle');
            $('.top-right').notify({
                type: 'success',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>You have successfully add a buyer.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            $scope.buyer_name = null;
            $http.get(app.host + 'production/buyer/fetchBuyersList').then(function (response) {
                $scope.num_of_items = 10;
                $scope.buyers = response.data;
                $scope.reverse = false;
            })
        }).error(function (result, status) {
            $('#add-buyer-modal').modal('toggle');
            $('.top-right').notify({
                type: 'danger',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>The operation was unsuccessful.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            $scope.buyer_name = null;
        });
    };
})

angular.module('myApp').controller('StyleController', function($scope, $http, $route, $routeParams) {
    $scope.loginUser = JSON.parse(sessionStorage.getItem('loginUser'));
    if($routeParams.style_id){
        $scope.style_id = $routeParams.style_id;
    }
    $scope.page_title = 'Styles List';
    $scope.num_of_items_arr = [{id: 5, value: 5},{id: 10, value: 10},{id: 20, value: 20},{id: 50, value: 50},{id: 100, value: 100}];
    $scope.reloadData = function(){
        $route.reload();
    };
    $http.get(app.host + '/production/style/fetchStylesList').then(function (response) {
        $scope.num_of_items = 10;
        $scope.styles = response.data;
        $scope.data_found = $scope.styles.length;
        $scope.reverse = false;
    });
    $scope.sortKey = 'style_name';
    $scope.sort = function (header) {
        $scope.sortKey = header;
        $scope.reverse = !$scope.reverse;
    };
    $scope.remove_style = function(id, name, action){
        if(action == 'single_delete')
        {
            $scope.style_name = name;
            $scope.style_id = id;
            $scope.status = 'single_delete';
            $scope.modal_msg = "Do you really want to delete the style "+$scope.style_name+".";
            $('#remove-style-modal').modal('toggle');
        }
        else if(action == 'all')
        {
            if($scope.styles.length == 0)
            {
                $('#removal-warning-modal').modal('toggle');
            }
            else
            {
                $scope.style_id = 0;
                $scope.status = 'all';
                $scope.modal_msg = "Do you really want to delete all styles";
                $('#remove-style-modal').modal('toggle');
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
            $scope.modal_msg = "Do you really want to delete selected styles";
            if(arr.length == 0)
            {
                $('#removal-warning-modal').modal('toggle');
            }
            else
            {
                $scope.style_id = arr;
                $('#remove-style-modal').modal('toggle');
            }
        }
    };
    $scope.remove_style_confirmed = function(id, page, action){
        $scope.style_name = null;
        var data = $.param({
            id: id,
            action: action
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        $http.post(app.host + 'production/style/delete', data, config).success(function (result, status) {
            console.log(result);
            $('#remove-style-modal').modal('toggle');
            $('.top-right').notify({
                type: 'success',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>Operation was successful.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            if(page == 'show_page')
            {
                window.location.href = '#/production/styles';
            }
            else
            {
                $http.get(app.host + 'production/style/fetchStylesList').then(function (response) {
                    $scope.num_of_items = 10;
                    $scope.styles = response.data;
                    $scope.reverse = false;
                })
            }
        }).error(function (result, status) {
            $('#remove-style-modal').modal('toggle');
            $('.top-right').notify({
                type: 'danger',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>Operation was unsuccessful. </strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
        });

    };
    $scope.init = function(id){
        $scope.page_title = 'Style Details';
        $http.get(app.host + 'production/styles/fetchStyleDetails/'+id).then(function(response){
            console.log(response)
            $scope.style = response.data;
        })
    };
    $scope.edit_style = function (id, edit_item, field, field_type, is_required, min_length, max_length, pattern, error_text) {
        $scope.editable_item = edit_item;
        $scope.style_id = id;
        $scope.field = field;
        $scope.field_type = field_type;
        $scope.is_required = is_required;
        $scope.min_length = min_length;
        $scope.max_length = max_length;
        $scope.pattern = pattern;
        $scope.error_text = error_text;
        $scope.type = null;
        $('#edit-style-modal').modal('toggle');
    }
    $scope.edit_style_confirmed = function (id) {
        $('#edit-style-modal').modal('toggle');
        if($scope.type == null)
        {
            $scope.type = '--';
        }
        $http.get(app.host + 'production/style/update/'+$scope.field+'/'+id+'/'+$scope.type).then(function(response){
            $('.top-right').notify({
                type: 'success',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>You have successfully updated the information.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            $scope.style = response.data;
            $http.get(app.host + 'production/styles/fetchStyleDetails/'+id).then(function(response){
                $scope.style = response.data;
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
    $scope.add_style = function(){
        var data = $.param({
            user_id: $scope.loginUser.id,
            style_name: $scope.style_name,
            image: $scope.new_file
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        $http.post(app.host + 'production/styles', data, config).success(function (result, status) {
            console.log(result)
            $('#add-style-modal').modal('toggle');
            $('.top-right').notify({
                type: 'success',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>Your operation has been successful..</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            $scope.style_name = null;
            $http.get(app.host + 'production/style/fetchStylesList').then(function (response) {
                $scope.num_of_items = 10;
                $scope.styles = response.data;
                $scope.reverse = false;
            })
        }).error(function (result, status) {
            $('#add-style-modal').modal('toggle');
            $('.top-right').notify({
                type: 'danger',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>The operation was unsuccessful.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            $scope.style_name = null;
        });
    };
})

angular.module('myApp').controller('OrderController', function($scope, $http, $routeParams) {
    $scope.loginUser = JSON.parse(sessionStorage.getItem('loginUser'));
    if($routeParams.order_id){
        $scope.order_id = $routeParams.order_id;
    }
    $scope.page_title = 'Order List';
    $scope.order = {};
    $scope.no_of_requisition_items = 10;
    $scope.order.total_yarn_weight = 0;
    $scope.order.total_yarn_cost = 0;
    compositions = new Array()
    n=0;
    $scope.add_to_requisitions = function(){
        var data = $.param({
            user_id: $scope.loginUser.id,
            order_id: $scope.order_id,
            yarn_type: $scope.yarn_type,
            yarn_amount: $scope.yarn_amount,
            accessories_amount: $scope.accessories_amount,
            button_amount: $scope.button_amount,
            zipper_amount: $scope.zipper_amount,
            print_amount: $scope.print_amount,
            zipper_amount: $scope.zipper_amount,
            security_tag_amount: $scope.security_tag_amount,
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        $http.post(app.host + 'production/order/addToRequisition', data, config).success(function (result, status) {
            console.log('rr')
            console.log(result)
            $('#add-order-modal').modal('toggle');
            $('.top-right').notify({
                type: 'success',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>The operation successfull.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
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
    $scope.update_order_info = function(){
        $scope.order.qty_per_dzn = Math.round($scope.order.order_qty/12*100, 2)/100;
        $scope.order.total_fob = $scope.order.order_qty * $scope.order.order_fob;
        $scope.order.total_accessories_cost = Math.round(($scope.order.qty_per_dzn * $scope.order.accessories_rate)*100)/100;
        $scope.order.total_button_cost = Math.round(($scope.order.qty_per_dzn * $scope.order.button_rate)*100)/100;
        $scope.order.total_zipper_cost = Math.round(($scope.order.qty_per_dzn * $scope.order.zipper_rate)*100)/100;
        $scope.order.total_print_cost = Math.round(($scope.order.qty_per_dzn * $scope.order.print_rate)*100)/100;
        $scope.order.total_security_tag_cost = Math.round(($scope.order.qty_per_dzn * $scope.order.security_tag)*100)/100;
        $scope.order.total_cost =  Math.round(($scope.order.total_yarn_cost + $scope.order.total_accessories_cost + $scope.order.total_button_cost + $scope.order.total_zipper_cost + $scope.order.total_print_cost + $scope.order.total_security_tag_cost)*100)/100;
        $scope.order.order_balance_amount = Math.round(($scope.order.total_fob - $scope.order.total_cost)*100)/100;
        $scope.order.cost_of_making = Math.round(($scope.order.order_balance_amount/$scope.order.qty_per_dzn)*100)/100;
    };
    $scope.composition_refresh = function(){
        $scope.order.total_yarn_weight = 0;
        $scope.order.total_yarn_cost = 0;
        $scope.order.total_yarn_weight = 0;
        $scope.order.total_yarn_cost = 0;
        document.getElementById('composition-div-group').innerHTML = "";
    };
    $scope.add_composition = function(){
        compositions[n] = [$scope.composition_name, $scope.composition_percentage, $scope.composition_yarn_rate, $scope.composition_wastage];
        composition_str = JSON.stringify(compositions);
        $scope.compositions = compositions;
        console.log($scope.compositions)
        n++;

        $scope.order.total_yarn_weight =  Number($scope.order.total_yarn_weight) + Number($scope.order.qty_per_dzn*$scope.order.weight_per_dzn*$scope.composition_percentage/100*(1+Number($scope.composition_wastage/100)));
        $scope.order.total_yarn_cost = Number($scope.order.total_yarn_cost) + Number(Number($scope.order.qty_per_dzn*$scope.order.weight_per_dzn*$scope.composition_percentage/100*(1+Number($scope.composition_wastage/100)))*$scope.composition_yarn_rate);
        $scope.order.total_yarn_weight = Math.round($scope.order.total_yarn_weight *100)/100;
        $scope.order.total_yarn_cost = Math.round($scope.order.total_yarn_cost *100)/100;
        table = document.getElementById('composition-div-group');
        row = table.insertRow(0);
        row.insertCell(0).innerHTML = $scope.composition_name;
        row.insertCell(1).innerHTML = $scope.composition_percentage;
        row.insertCell(2).innerHTML = $scope.composition_yarn_rate;
        row.insertCell(3).innerHTML = $scope.composition_wastage;
        //console.log($scope.total_yarn_weight+ " = "+ $scope.total_yarn_cost+" = "+$scope.composition_yarn_rate +" = "+$scope.composition_wastage)
    };
    $scope.num_of_items_arr = [{id: 5, value: 5},{id: 10, value: 10},{id: 20, value: 20},{id: 50, value: 50},{id: 100, value: 100}];
    $http.get(app.host + 'production/order/fetchOrdersList').then(function (response) {
        console.log(response.data)
        $scope.num_of_items = 10;
        $scope.orders = response.data;
        $scope.reverse = false;
    });
    $http.get(app.host + 'production/buyer/fetchBuyersList').then(function (response) {
        $scope.num_of_items = 10;
        $scope.buyers = response.data;
        $scope.reverse = false;
    });
    $http.get(app.host + 'production/style/fetchStylesList').then(function (response) {
        $scope.num_of_items = 10;
        $scope.styles = response.data;
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
            $scope.modal_msg = "Do you really want to delete the order id:  "+$scope.id+".";
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
    $scope.advanced_search_order = function()
    {
        var data = $.param({
            field: $scope.report.field,
            operator: $scope.report.operator,
            search_value: $scope.report.search_value
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        $http.post(app.host + 'production/reports/orders/search', data, config).success(function (result, status) {

            $scope.orders = result;
            console.log(result)
        });
    }
    $scope.remove_order_confirmed = function(id, page, action){
        $scope.order_name = null;
        var data = $.param({
            id: id,
            action: action,
            user_id: $scope.loginUser.id,
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
            $('#remove-buyer-modal').modal('toggle');
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
        $scope.yarn_type = '';
        $http.get(app.host + 'production/orders/fetchOrderDetails/'+id).then(function(response){
            $scope.delivery_date = new Date(response.data[0].delivery_date);
            $scope.today = new Date();
            $scope.days_left_to_delivery = ($scope.delivery_date - $scope.today)/1000/60/60/24;
            $scope.order_id = id;
            console.log(response.data)
            $scope.order_details = response.data;
            $scope.approved_amount_of_requisition = Number(response.data[0].approved_yarn_amount) +Number(response.data[0].approved_acc_amount) +Number(response.data[0].approved_btn_amount) +Number(response.data[0].approved_zipper_amount) +Number(response.data[0].approved_print_amount) +Number(response.data[0].approved_security_tag_cost)
            console.log('dd')
            console.log(response.data[0].approved_acc_amount)

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
        var data = $.param({
            user_id: $scope.loginUser.id,
            id: id,
            field: $scope.field,
            value: $scope.type
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        $http.post(app.host + 'production/order/update', data, config).success(function (result, status) {
            console.log(result)
            $('.top-right').notify({
                type: 'success',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>Your operation has been successful..</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            $http.get(app.host + 'production/orders/fetchOrderDetails/'+id).then(function(response){
                $scope.order_details = response.data;
            })
        }).error(function (result, status) {
            $('.top-right').notify({
                type: 'danger',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>The operation was unsuccessful.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
        });
    };
    $scope.add_order = function(form){
        var data = $.param({
            user_id: $scope.loginUser.id,
            buyer_id: $scope.order.buyer_id,
            style_id: $scope.order.style_id,
            order_date: $scope.order.order_date,
            delivery_date: $scope.order.delivery_date,
            order_gg: $scope.order.order_gg,
            order_qty: $scope.order.order_qty,
            order_fob: $scope.order.order_fob,
            weight_per_dzn: $scope.order.weight_per_dzn,
            qty_per_dzn: $scope.order.qty_per_dzn,
            total_yarn_weight: $scope.order.total_yarn_weight,
            total_yarn_cost: $scope.order.total_yarn_cost,
            accessories_rate: $scope.order.accessories_rate,
            total_accessories_cost: $scope.order.total_accessories_cost,
            button_rate: $scope.order.button_rate,
            total_button_cost: $scope.order.total_button_cost,
            zipper_rate: $scope.order.zipper_rate,
            total_zipper_cost: $scope.order.total_zipper_cost,
            print_rate: $scope.order.print_rate,
            total_print_cost: $scope.order.total_print_cost,
            security_tag_cost: $scope.order.security_tag,
            total_security_tag_cost: $scope.order.total_security_tag_cost,
            total_fob: $scope.order.total_fob,
            total_cost: $scope.order.total_cost,
            order_balance_amount: $scope.order.order_balance_amount,
            cost_of_making: $scope.order.cost_of_making,
            compositions: $scope.compositions
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        $http.post(app.host + 'production/orders', data, config).success(function (result, status) {
            console.log(result)
            $('#add-order-modal').modal('toggle');
            $('.top-right').notify({
                type: 'success',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>You have successfully add a order.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
          //  $scope.order = {};
            $scope.compositions = null;
            document.getElementById('composition-div-group').innerHTML = '';
            $http.get(app.host + 'production/order/fetchOrdersList').then(function (response) {
                $scope.num_of_items = 10;
                $scope.orders = response.data;
                $scope.reverse = false;
            });
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


angular.module('myApp').controller('RequisitionController', function($scope, $http){
    $scope.loginUser = JSON.parse(sessionStorage.getItem('loginUser'));
    $scope.user_id = $scope.loginUser.id;
    $scope.page_title = 'Requisitions';
    $scope.total_requisition_amount = 0;
    items = new Array();
    $http.get(app.host + 'user/getUsersList').then(function (response) {
        console.log('done'+response.data)
        $scope.users = response.data.users;
        console.log('ffff');
        console.log(response.data.users)
    });
    $scope.select_requisition = function(val, requisition_id){
        if(this.chkbox)
        {
            items.push(requisition_id);
            $scope.requisition_items = items;
            $scope.total_requisition_amount = Number($scope.total_requisition_amount) + Number(val);
        }
        else
        {
            index = items.indexOf(requisition_id);
            items.splice(index, 1);
            $scope.requisition_items = items;
            $scope.total_requisition_amount = Number($scope.total_requisition_amount) - Number(val);
        }
    };
    $scope.remove_item = function(id, name, action){
        if(action == 'single_delete')
        {
            $scope.item_name = name;
            $scope.item_id = id;
            $scope.status = 'single_delete';
            $scope.modal_msg = "Do you really want to delete this item?" ;
            $('#remove-item-modal').modal('toggle');
        }
        else if(action == 'all')
        {
            if($scope.lists.length == 0)
            {
                $('#removal-warning-modal').modal('toggle');
            }
            else
            {
                $scope.style_id = 0;
                $scope.status = 'all';
                $scope.modal_msg = "Do you really want to delete all items";
                $('#remove-item-modal').modal('toggle');
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
            $scope.modal_msg = "Do you really want to delete selected items";
            if(arr.length == 0)
            {
                $('#removal-warning-modal').modal('toggle');
            }
            else
            {
                $scope.item_id = arr;
                $('#remove-item-modal').modal('toggle');
            }
        }
    };
    $scope.remove_item_confirmed = function(id, page, action){
        $scope.item_name = null;
        $http.delete(app.host + 'production/requisitions/'+id+"/"+action).then(function(response){
            console.log('+++');console.log(id)
            $('#remove-item-modal').modal('toggle');
            $('.top-right').notify({
                type: 'success',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>You have successfully deleted the information.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show()
            $http.get(app.host + 'production/requisitions/getRequisitionItems').then(function (response) {
                console.log('done'+response.data)
                $scope.lists = response.data.items;
                console.log(response.data)
            });
        }, function(error_response){
            $('#remove-style-modal').modal('toggle');
            $('.top-right').notify({
                type: 'danger',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>Operation was unsuccessful. </strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
        })
    };
    $scope.generate_requisition = function(){
        var data = $.param({
            user_id: $scope.loginUser.id,
            total_amount: $scope.total_requisition_amount,
            requisition_items: $scope.requisition_items,
            forwarded_to: $scope.fowarded_to,
            requisition_title: $scope.requisition_title
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        $http.post(app.host + 'production/requisitions/generateRequisition', data, config).success(function (result, status) {
            console.log(result)
            $('#add-order-modal').modal('toggle');
            $('.top-right').notify({
                type: 'success',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>The operation successfull.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            $http.get(app.host + 'production/requisitions/getRequisitionItems/'+$scope.user_id).then(function (response) {
                console.log('done'+response.data)
                $scope.lists = response.data.items;
                $scope.total_requisition_amount = 0;
            });
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
    $http.get(app.host + 'production/requisitions/getRequisitionItems/'+$scope.user_id).then(function (response) {
        console.log('done'+response.data)
        $scope.lists = response.data.items;
        console.log(response.data)
    });
})


angular.module('myApp').controller('AllRequisitionController', function($scope, $http, $routeParams) {
    $scope.loginUser = JSON.parse(sessionStorage.getItem('loginUser'));
    if($routeParams.requisition_id){
        $scope.requisition_id = $routeParams.requisition_id;
    }
    $scope.total_approved_amount = 0;
    $scope.approved_amount = 0;
    $scope.get_total_approved_amount = function(){
        count = $scope.requisitions.length;
        total = 0;
        for(i=0;i<count;i++){
            total += Number($scope.requisitions[i]['item_approved_amount']);
        }
        return total;
    };
    $scope.act_on_requisition = function(id, amount, flag) {
        amount_arr = JSON.stringify($scope.items_arr);
        console.log('---')
        console.log(amount_arr);
        data = $.param({
            requisition_id: id,
            amount: amount,
            arr_item: $scope.items_arr,
            flag: flag
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        $http.post(app.host + 'production/requisition/approve', data, config).success(function (result, status) {
            console.log(result)
            $('.top-right').notify({
                type: 'success',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>The operation was successfull.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            $scope.hide_button = 1;
        }).error(function (result, status) {
            $('.top-right').notify({
                type: 'danger',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>The operation was unsuccessful.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
        });
    }
    i = 0;
    items = new Array();
    $scope.add_amount = function(requisition_item_id, amount, item_type, order_id, index){

        items[index] = requisition_item_id+"#"+amount+"#"+item_type+"#"+order_id;
        $scope.items_arr = items;
        console.log($scope.items_arr)
        $scope.total_approved_amount = Number($scope.total_approved_amount) + Number(amount);
    };
    $scope.initialize = function (page) {
        $scope.page_title = "Requisition " + page;
        $http.get(app.host + 'production/requisitions/'+page+'/get/'+$scope.loginUser.id).then(function (response) {
            $scope.num_of_items = 10;
            $scope.requisitions = response.data.requisition;
            $scope.requisition_items = response.data.requisition_items;
            console.log('ttt')
            console.log(response.data)
            $scope.reverse = false;
        });
    }
    $scope.getRequisitionDetails = function(id){
        $scope.page_title = 'Requisition Details';
        $scope.user_id = $scope.loginUser.id;
        $http.get(app.host + 'production/requisitions/getDetails/'+id).then(function (response) {
            $scope.requisitions = response.data.requisition;
        });
    };
    $scope.num_of_items_arr = [{id: 5, value: 5},{id: 10, value: 10},{id: 20, value: 20},{id: 50, value: 50},{id: 100, value: 100}];


    $scope.sortKey = 'requisition_name';
    $scope.sort = function (header) {
        $scope.sortKey = header;
        $scope.reverse = !$scope.reverse;
    };
    $scope.remove_requisition = function(id, name, action){
        if(action == 'single_delete')
        {
            $scope.requisition_name = name;
            $scope.requisition_id = id;
            $scope.status = 'single_delete';
            $scope.modal_msg = "Do you really want to delete the requisition "+$scope.requisition_name+".";
            $('#remove-requisition-modal').modal('toggle');
        }
        else if(action == 'all')
        {
            if($scope.requisitions.length == 0)
            {
                $('#removal-warning-modal').modal('toggle');
            }
            else
            {
                $scope.requisition_id = 0;
                $scope.status = 'all';
                $scope.modal_msg = "Do you really want to delete all requisitions";
                $('#remove-requisition-modal').modal('toggle');
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
            $scope.modal_msg = "Do you really want to delete selected requisitions";
            if(arr.length == 0)
            {
                $('#removal-warning-modal').modal('toggle');
            }
            else
            {
                $scope.requisition_id = arr;
                $('#remove-requisition-modal').modal('toggle');
            }
        }
    };
    $scope.remove_requisition_confirmed = function(id, page, action){
        $scope.requisition_name = null;
        $http.delete(app.host + 'production/requisition_main/'+id+"/"+action).then(function(response){
            console.log(response)
            $('#remove-requisition-modal').modal('toggle');
            $('.top-right').notify({
                type: 'success',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>You have successfully deleted the information.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            if(page == 'show_page')
            {
                window.location.href = '#/production/requisitions';
            }
            else
            {
                $http.get(app.host + 'production/requisitions/sent/get').then(function (response) {
                    $scope.num_of_items = 10;
                    $scope.requisitions = response.data;
                    $scope.reverse = false;
                })
            }
        }, function(error_response){
            $('#remove-requisition-modal').modal('toggle');
            $('.top-right').notify({
                type: 'danger',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>Operation was unsuccessful. </strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
        })
    };
    $scope.init = function(id){
        $http.get(app.host + 'production/requisitions/fetchAllRequisitionDetails/'+id).then(function(response){
            $scope.requisition = response.data;
        })
    };
    $scope.edit_requisition = function (id, edit_item, field, field_type, is_required, min_length, max_length, pattern, error_text) {
        $scope.editable_item = edit_item;
        $scope.requisition_id = id;
        $scope.field = field;
        $scope.field_type = field_type;
        $scope.is_required = is_required;
        $scope.min_length = min_length;
        $scope.max_length = max_length;
        $scope.pattern = pattern;
        $scope.error_text = error_text;
        $scope.type = null;
        $('#edit-requisition-modal').modal('toggle');
    }
    $scope.edit_requisition_confirmed = function (id) {
        $('#edit-requisition-modal').modal('toggle');
        if($scope.type == null)
        {
            $scope.type = '--';
        }
        $http.get(app.host + 'production/requisition/update/'+$scope.field+'/'+id+'/'+$scope.type).then(function(response){
            $('.top-right').notify({
                type: 'success',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>You have successfully updated the information.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            $scope.requisition = response.data;
            $http.get(app.host + 'production/requisitions/fetchAllRequisitionDetails/'+id).then(function(response){
                $scope.requisition = response.data;
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
    $scope.add_requisition = function(){
        var data = $.param({
            requisition_name: $scope.requisition_name,
            postal_address: $scope.postal_address,
            contact_person: $scope.contact_person,
            email_address: $scope.email_address,
            contact_number: $scope.contact_number,
            website: $scope.website,
            requisition_image: $scope.requisition_image
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        $http.post(app.host + 'production/requisitions', data, config).success(function (result, status) {
            $('#add-requisition-modal').modal('toggle');
            $('.top-right').notify({
                type: 'success',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>You have successfully add a requisition.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            $scope.requisition_name = null;
            $http.get(app.host + 'production/requisition/fetchAllRequisitionsList').then(function (response) {
                $scope.num_of_items = 10;
                $scope.requisitions = response.data;
                $scope.reverse = false;
            })
        }).error(function (result, status) {
            $('#add-requisition-modal').modal('toggle');
            $('.top-right').notify({
                type: 'danger',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>The operation was unsuccessful.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            $scope.requisition_name = null;
        });
    };
})

angular.module('myApp').controller('LogoutController', function($scope, $http, $window){
    $scope.doLogout = function() {
        sessionStorage.removeItem('loginUser');
        $window.location.href = 'login';
    }
})

