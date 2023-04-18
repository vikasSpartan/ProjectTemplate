<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard(Request $request){
        return view('dashboard');
    }

    public function logoutUser(){
        \Session::flush();
        \Auth::logout();
        return redirect("login");
    }
}
