<?php namespace Modules\Accouts\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class AccoutsController extends Controller {
	
	public function index()
	{
		return view('accouts::index');
	}
	
}