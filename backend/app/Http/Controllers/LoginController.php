<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index(){
        if(Auth::check()){
            return redirect('/dashboard');
        }
        else{
            return view('login/login_form');
        }
    }

    public function isUserLoggedIn(){
        if(Auth::check()){
            return redirect('/dashboard');
        }
        else{
            return redirect('/login');
        }
    }

    public function get_token()
    {
        return Session::token();
    }

    public function processLogin(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return Auth::user();
        }
        else{
            return -1;
        }
    }

    public function doLogout(){
        Auth::logout();
        return redirect('/');
    }
}
