<?php namespace Modules\Hrm\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class HrmController extends Controller {
	
	public function index()
	{
		return view('hrm::index');
	}
	
}