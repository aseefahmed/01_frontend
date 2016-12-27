<?php namespace Modules\Crm\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class CrmController extends Controller {
	
	public function index()
	{
		return view('crm::index');
	}
	
}