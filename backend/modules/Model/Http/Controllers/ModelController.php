<?php namespace Modules\Model\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class ModelController extends Controller {
	
	public function index()
	{
		return view('model::index');
	}
	
}