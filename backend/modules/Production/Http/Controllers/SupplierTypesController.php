<?php namespace Modules\Production\Http\Controllers;

use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;
use Modules\Production\Entities\SupplierType;
use Pingpong\Modules\Routing\Controller;

class SupplierTypesController extends Controller {

    public function index()
    {
        return view('production::supplier_types.index');
    }

    public function fetchSupplierTypesList()
    {
        return SupplierType::all();
    }

    public function show($id){
        $data['supplier_type_id'] = $id;
        return view('production::supplier_types.show', $data);
    }

    public function fetchSupplierTypeDetails($id){
        $data['supplier_type'] =  SupplierType::where('id', $id)->get();
        $data['supplier_type']['user_name'] = $data['supplier_type'][0]->user;
        return $data['supplier_type'];
    }

    public function destroy(Request $request, $id, $action=null){

        if($action == 'all')
        {
            SupplierType::truncate();
        }
        elseif($action == 'single_delete')
        {
            SupplierType::find($id)->delete();
        }
        else if($action == 'selected')
        {
            $items = explode(',', $id);
            SupplierType::destroy($items);
        }

    }

    public function updateField($field, $id, $value)
    {
        SupplierType::where('id', $id)->update([
            $field => $value
        ]);
    }

    public function store(Request $request){
        $supplier_type_id = SupplierType::max('id')+1;
        $supplier_type = new SupplierType();
        $supplier_type->supplier_type = $request->supplier_type;
        $supplier_type->user_id = Auth::user()->id;
        if($request->supplier_type_image != ""){
            $file_extension = $request->file('supplier_type_image')->guessExtension();
            $img_name = $supplier_type_id.".".$file_extension;
            $request->file('supplier_type_image')->move('img/uploads/production/supplier_types', $img_name);
        }else{
            $img_name = "no_image.jpg";
        }
        $supplier_type->image = $img_name;
        $supplier_type->save();
    }

}