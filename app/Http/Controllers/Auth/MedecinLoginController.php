<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedecinLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware("guest:medecin");
    }

    public function showLoginForm(){

        return view("auth.medecin.login");
    }
    public function login(Request $request){
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>"required|min:6"
        ]);
       if ( Auth::guard('medecin')->attempt(['email'=>$request->input('email'), 'password'=>$request->input('password')])){
           $request->session()->put("medecinSession","medecin");
           //session(['medecinSession' => 'medecin']);
             return redirect()->intended(route('medecinIndex'));
       }
       return back()->withInput($request->only('email'));
    }

}
