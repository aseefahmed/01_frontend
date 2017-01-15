angular.module('myApp').controller('BuyingOrderController', function($scope, $http, $route, Upload){
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
	            $scope.reverse = false;
	        });
	        $http.get(app.host + '/production/buyer/fetchBuyersList').then(function (response) {
            $scope.buyers = response.data;
            $scope.reverse = false;
        });

	    }
		$scope.init = function(id){
	        $scope.page_title = 'Order Details';
	        $scope.host = app.host;
	        $scope.yarn_type = '';
	        $http.get(app.host + 'production/orders/fetchOrderDetails/'+id).then(function(response){
	            console.log('777777777777')
	            console.log(response)
	            $scope.delivery_date = new Date(response.data[0].delivery_date);
	            $scope.today = new Date();
	            $scope.days_left_to_delivery = ($scope.delivery_date - $scope.today)/1000/60/60/24;
	            $scope.order_id = id;
	            console.log(response.data)
	            $scope.order_details = response.data;
	            $scope.due_yarn_amount = $scope.order_details[0].total_yarn_cost - $scope.order_details[0].approved_yarn_amount;
	            $scope.due_acc_amount = $scope.order_details[0].total_acc_cost - $scope.order_details[0].approved_acc_amount;
	            $scope.due_btn_amount = $scope.order_details[0].total_btn_cost - $scope.order_details[0].approved_btn_amount;
	            $scope.due_zipper_amount = $scope.order_details[0].total_zipper_cost - $scope.order_details[0].approved_zipper_amount;
	            $scope.due_print_amount = $scope.order_details[0].total_print_cost - $scope.order_details[0].approved_print_amount;
	            $scope.due_security_tag_amount = $scope.order_details[0].total_security_tag_cost - $scope.order_details[0].approved_security_tag_cost;
	            console.log($scope.yarn_amount)
	            $scope.approved_amount_of_requisition = Number(response.data[0].approved_yarn_amount) +Number(response.data[0].approved_acc_amount) +Number(response.data[0].approved_btn_amount) +Number(response.data[0].approved_zipper_amount) +Number(response.data[0].approved_print_amount) +Number(response.data[0].approved_security_tag_cost)


	        })
	    };
		$scope.add_buying_order = function(form, myfile){
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
                sketch: myfile
            },
        }).then(function (response) {
            $('#add-order-modal').modal('toggle');
            $('.top-right').notify({
                type: 'success',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>You have successfully add an order.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
            $scope.order = {};
            
        }, function (response) {console.log(data)
            $('#add-buyer-modal').modal('toggle');
            $('.top-right').notify({
                type: 'danger',
                message: { html: '<span class="glyphicon glyphicon-info-sign"></span> <strong>The operation was unsuccessful.</strong>' },
                closable: false,
                fadeOut: { enabled: true, delay: 2000 }
            }).show();
        });

    };
})