<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware("guest:admin");
    }

    public function showLoginForm(){

        return view("auth.admin.login");
    }
    public function login(Request $request){
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>"required|min:6"
        ]);
       if ( Auth::guard('admin')->attempt(['email'=>$request->input('email'), 'password'=>$request->input('password')])){

             return redirect()->intended(route('adminIndex'));
       }
       return back()->withInput($request->only('email'));
    }

}
