<?php namespace Modules\Production\Http\Controllers;

use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\DB;
use Modules\Production\Entities\Activity;
use Modules\Production\Entities\Order;
use Modules\Production\Entities\RequisitionItem;
use Modules\Production\Entities\RequisitionType;
use Pingpong\Modules\Routing\Controller;

class OrdersController extends Controller {

    public function index()
    {
        return view('production::orders.index');
    }

    public function fetchOrdersList()
    {
        $orders = DB::table('orders')->leftJoin('buyers', 'orders.buyer_id', '=', 'buyers.id')->leftJoin('styles', 'orders.style_id', '=', 'styles.id')->select('orders.*', 'buyers.buyer_name', 'styles.image as style_image', 'styles.style_name')->get();
        return $orders;
    }

    public function show($id){
        $data['order_id'] = $id;
        return view('production::orders.show', $data);
    }

    function fetchOrdersSummery()
    {
        $date_of_seven_days_ago = date("Y-m-d", strtotime("-1 week"));
        $date_of_14_days_ago = date("Y-m-d", strtotime("-2 week"));
        $data['new_orders'] = DB::table('orders')->leftJoin('buyers', 'orders.buyer_id', '=', 'buyers.id')->leftJoin('styles', 'orders.style_id', '=', 'styles.id')->where('orders.created_at', '>', $date_of_seven_days_ago)->select('orders.*', 'buyers.buyer_name', 'styles.image as style_image', 'styles.style_name')->get();
        $data['inactive_orders'] = DB::table('orders')->leftJoin('buyers', 'orders.buyer_id', '=', 'buyers.id')->leftJoin('styles', 'orders.style_id', '=', 'styles.id')->where('orders.updated_at', '<', $date_of_seven_days_ago)->select('orders.*', 'buyers.buyer_name', 'styles.image as style_image', 'styles.style_name')->get();
        return $data;
    }
    public function fetchOrderDetails($id){
        $data['order'] =  Order::where('id', $id)->select('orders.*')->get();
        $data['order']['user'] = $data['order'][0]->user;
        $data['order']['buyer'] = $data['order'][0]->buyer;
        $data['order']['style'] = $data['order'][0]->style;
        $data['order']['composition'] = unserialize($data['order'][0]->compositions);
        $data['order']['total_requisition_pending'] = RequisitionItem::where('reference', $id)->where('requisition_id','>',0)->where('flag',1)->count();
        $data['order']['total_requisition_approved'] = RequisitionItem::where('reference', $id)->where('requisition_id','>',0)->where('flag',2)->count();
        $data['order']['total_requisition_rejected'] = RequisitionItem::where('reference', $id)->where('requisition_id','>',0)->where('flag',9)->count();
        $data['order']['days_left_to_delivery'] = RequisitionItem::where('reference', $id)->where('flag',2)->count();
        return $data['order'];
    }

    public function deleteOrder(Request $request){
        $activity = new Activity();

        if($request->action == 'all')
        {
            Order::truncate();
        }
        elseif($request->action == 'single_delete')
        {
            Order::find($request->id)->delete();
        }
        else if($request->action == 'selected')
        {
            Order::destroy($request->id);
        }

        $activity->user_id = $request->user_id;
        $activity->reference_table = 'orders';
        $activity->reference = serialize($request->id);
        $activity->ip_address = $_SERVER["REMOTE_ADDR"];
        $activity->save();
    }

    public function updateField(Request $request)
    {
        DB::table('orders')
            ->where('id', $request->id)
            ->update([$request->field => $request->value]);

        $activity = new Activity();
        $activity->user_id = $request->user_id;
        $activity->reference_table = 'orders';
        $activity->reference = serialize($request->id);
        $activity->description = 'An order information has been updated. '. $request->field . ' has been set to '. $request->value . ' for order ID:'. $request->id;
        $activity->ip_address = $_SERVER["REMOTE_ADDR"];
        $activity->save();
    }


    public function store(Request $request){
        $order_id = time();
        $order = new Order();
        $order->id = $order_id;
        $order->user_id = $request->user_id;
        $order->buyer_id = $request->buyer_id;
        $order->style_id = $request->style_id;
        $order->order_date = $request->order_date;
        $order->delivery_date = $request->delivery_date;
        $order->gg = $request->order_gg;
        $order->qty = $request->order_qty;
        $order->fob = $request->order_fob;
        $order->weight_per_dzn = $request->weight_per_dzn;
        $order->total_yarn_weight = $request->total_yarn_weight;
        $order->qty_per_dzn = $request->qty_per_dzn;
        $order->total_yarn_weight = $request->total_yarn_weight;
        $order->total_yarn_cost = $request->total_yarn_cost;
        $order->acc_rate  = $request->accessories_rate;
        $order->total_acc_cost  = $request->total_accessories_cost ;
        $order->btn_cost  = $request->button_rate;
        $order->total_btn_cost  = $request->total_button_cost;
        $order->zipper_cost  = $request->zipper_rate;
        $order->total_zipper_cost  = $request->total_zipper_cost;
        $order->print_cost = $request->print_rate;
        $order->total_print_cost = $request->total_print_cost;
        $order->security_tag_cost = $request->security_tag_cost;
        $order->total_security_tag_cost = $request->total_security_tag_cost;
        $order->total_fob = $request->total_fob;
        $order->total_cost = $request->total_cost;
        $order->balance_amount = $request->order_balance_amount;
        $order->cost_of_making = $request->cost_of_making;
        $order->compositions = serialize($request->compositions);
        $order->save();

        $activity = new Activity();
        $activity->user_id = $request->user_id;
        $activity->reference_table = 'orders';
        $activity->reference = serialize(Order::max('id'));
        $activity->description = 'An order has been created.';
        $activity->ip_address = $_SERVER["REMOTE_ADDR"];
        $activity->save();
    }

    public function addToRequisition(Request $request){
        if($request->yarn_amount != '') {
            DB::table('requisition_items')->insert([
                'item_name' => 'Composition: ' . $request->yarn_type,
                'items_val' => $request->yarn_amount,
                'requisition_type' => 'Order',
                'user_id' => $request->user_id,
                'reference' => $request->order_id,
            ]);
        }
        if($request->accessories_amount != ''){
            DB::table('requisition_items')->insert([
                'item_name' => 'Accessories',
                'items_val' => $request->accessories_amount,
                'requisition_type' => 'Order',
                'user_id' => $request->user_id,
                'reference' => $request->order_id,
            ]);
        }

        if($request->button_amount != ''){
            DB::table('requisition_items')->insert([
                'item_name' => 'Button',
                'items_val' => $request->button_amount,
                'requisition_type' => 'Order',
                'user_id' => $request->user_id,
                'reference' => $request->order_id,
            ]);
        }

        if($request->print_amount != ''){
            DB::table('requisition_items')->insert([
                'item_name' => 'Print',
                'items_val' => $request->print_amount,
                'requisition_type' => 'Order',
                'user_id' => $request->user_id,
                'reference' => $request->order_id,
            ]);
        }

        if($request->zipper_amount != ''){
            DB::table('requisition_items')->insert([
                'item_name' => 'Zipper',
                'items_val' => $request->zipper_amount,
                'requisition_type' => 'Order',
                'user_id' => $request->user_id,
                'reference' => $request->order_id,
            ]);
        }

        if($request->security_tag_amount != ''){
            DB::table('requisition_items')->insert([
                'item_name' => 'Security Tag',
                'items_val' => $request->security_tag_amount,
                'requisition_type' => 'Order',
                'user_id' => $request->user_id,
                'reference' => $request->order_id,
            ]);
        }


    }

}