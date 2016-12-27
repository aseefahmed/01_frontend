<?php namespace Modules\Production\Http\Controllers;

use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;
use Modules\Production\Entities\Supplier;
use Pingpong\Modules\Routing\Controller;

class SuppliersController extends Controller {

    public function index()
    {
        return view('production::suppliers.index');
    }

    public function fetchSuppliersList()
    {
        return Supplier::all();
    }

    public function show($id){
        $data['supplier_id'] = $id;
        return view('production::suppliers.show', $data);
    }

    public function fetchSupplierDetails($id){
        $data['supplier'] =  Supplier::where('id', $id)->get();
        $data['supplier']['user_name'] = $data['supplier'][0]->user;
        $data['supplier']['supplier_type'] = $data['supplier'][0]->supplier_type;
        return $data['supplier'];
    }

    public function destroy(Request $request, $id, $action=null){

        if($action == 'all')
        {
            Supplier::truncate();
        }
        elseif($action == 'single_delete')
        {
            Supplier::find($id)->delete();
        }
        else if($action == 'selected')
        {
            $items = explode(',', $id);
            Supplier::destroy($items);
        }

    }

    public function updateField($field, $id, $value)
    {
        Supplier::where('id', $id)->update([
            $field => $value
        ]);
    }

    public function store(Request $request){
        $supplier_id = Supplier::max('id')+1;
        $supplier = new Supplier();
        $supplier->supplier_type_id = $request->supplier_type_id;
        $supplier->supplier_name = $request->supplier_name;
        $supplier->contact_person = $request->contact_person;
        $supplier->postal_address = $request->postal_address;
        $supplier->contact_number = $request->contact_number;
        $supplier->email_address = $request->email_address;
        $supplier->website = $request->website;
        $supplier->user_id = Auth::user()->id;
        if($request->supplier_image != ""){
            $file_extension = $request->file('supplier_image')->guessExtension();
            $img_name = $supplier_id.".".$file_extension;
            $request->file('supplier_image')->move('img/uploads/production/suppliers', $img_name);
        }else{
            $img_name = "no_image.jpg";
        }
        $supplier->image = $img_name;
        $supplier->save();
    }
	
}