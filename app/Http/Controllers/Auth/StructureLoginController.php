<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StructureLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware("guest:structure");
    }

    public function showLoginForm(){

        return view("auth.structure.login");
    }
    public function login(Request $request){
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>"required|min:6"
        ]);
        if ( Auth::guard('structure')->attempt(['email'=>$request->input('email'), 'password'=>$request->input('password')])){
            return redirect()->intended(route('structureIndex'));
        }
        return back()->withInput($request->only('email'));
    }
}
