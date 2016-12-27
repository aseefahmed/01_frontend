<?php namespace Modules\Production\Http\Controllers;

use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;
use Modules\Production\Entities\Style;
use Pingpong\Modules\Routing\Controller;

class StylesController extends Controller {

    public function index()
    {
        return view('production::styles.index');
    }

    public function fetchStylesList()
    {
        return Style::all();
    }

    public function show($id){
        $data['style_id'] = $id;
        return view('production::styles.show', $data);
    }

    public function fetchStyleDetails($id){
        $data['style'] =  Style::where('id', $id)->get();
        $data['style']['user_name'] = $data['style'][0]->user;
        return $data['style'];
    }

    public function deleteStyle(Request $request){

        if($request->action == 'all')
        {
            Style::truncate();
        }
        elseif($request->action == 'single_delete')
        {
            Style::find($request->id)->delete();
        }
        else if($request->action == 'selected')
        {
            Style::destroy($request->id);
        }
    }

    public function updateField($field, $id, $value)
    {
        Style::where('id', $id)->update([
            $field => $value
        ]);
    }

    public function store(Request $request){
        $style_id = Style::max('id')+1;
        $style = new Style();
        $style->style_name = $request->style_name;
        $style->user_id = $request->user_id;

        if($request->file != ""){
            $file_extension = $request->file('file')->guessExtension();
            $img_name = $style_id.".".$file_extension;
            $request->file('file')->move('img/uploads/production/styles', $img_name);
        }else{
            $img_name = "no_image.jpg";
        }
        $style->image = $img_name;
        $style->save();
    }

}