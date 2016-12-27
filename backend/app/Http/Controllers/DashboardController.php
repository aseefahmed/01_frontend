<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class DashboardController extends Controller
{
    public function viewDashboard(){
        return view('dashboard');
    }


    public function viewCockpit(){
        return view('new');
    }
}
