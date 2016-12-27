<?php namespace Modules\Production\Http\Controllers;

use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\DB;
use Modules\Production\Entities\Report;
use Pingpong\Modules\Routing\Controller;

class ReportsController extends Controller {

    public function index($id)
    {
        return view('production::reports.index');
    }

    public function fetchReportsList()
    {
        return Report::all();
    }

    public function show($id){
        $data['report_id'] = $id;
        return view('production::reports.show', $data);
    }

    public function fetchReportDetails($id){
        $data['report'] =  Report::where('id', $id)->get();
        $data['report']['user_name'] = $data['report'][0]->user;
        return $data['report'];
    }

    public function destroy(Request $request, $id, $action=null){

        if($action == 'all')
        {
            Report::truncate();
        }
        elseif($action == 'single_delete')
        {
            Report::find($id)->delete();
        }
        else if($action == 'selected')
        {
            $items = explode(',', $id);
            Report::destroy($items);
        }

    }

    public function updateField($field, $id, $value)
    {
        Report::where('id', $id)->update([
            $field => $value
        ]);
    }

    public function store(Request $request){
        $report_id = Report::max('id')+1;
        $report = new Report();
        $report->report_name = $request->report_name;
        $report->postal_address = $request->postal_address;
        $report->contact_person = $request->contact_person;
        $report->contact_number = $request->contact_number;
        $report->email_address = $request->email_address;
        $report->website = $request->website;
        $report->user_id = Auth::user()->id;
        if($request->report_image != ""){
            $file_extension = $request->file('report_image')->guessExtension();
            $img_name = $report_id.".".$file_extension;
            $request->file('report_image')->move('img/uploads/production/reports', $img_name);
        }else{
            $img_name = "no_image.jpg";
        }
        $report->image = $img_name;
        $report->save();
    }

    public function generateReport($report_type){
        return view('production::reports.orders');
    }

    public function searcReport(Request $request, $search_type)
    {
        if($search_type == 'orders')
        {
            $data['orders'] = DB::table('orders');
            $data['orders'] = $data['orders']->where($request->field, $request->operator, $request->search_value);
            $data = $data['orders']->select('orders.*')->get();
            return $data;
        }
    }
}