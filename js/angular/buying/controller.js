angular.module('myApp').controller('BuyingOrderController', function($scope, $http, $routeParams, $route, Upload){
		$scope.loginUser = JSON.parse(sessionStorage.getItem('loginUser'));
        if($routeParams.order_id){
            $scope.order_id = $routeParams.order_id;
        }
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
		$scope.init = function(id){alert(id)
	        $scope.page_title = 'Order Details';
	        $scope.host = app.host;

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