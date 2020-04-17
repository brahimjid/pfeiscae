<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Medecin;
use App\SuperAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SuperAdminRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware("guest:admin");
    }
    public function showRegisterForm(){

        return view("auth.admin.register");
    }
    protected function validator(array $data)
    {
        //  id	nom	prenom	username	email	password	img	idSpecialite	idStructure
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:100', 'unique:superAdmins'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:superAdmins'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function register(Request $request)
    {
        $admin = new SuperAdmin();
        $admin->username = $request->input('username') ;
        $admin->email = $request->input('email') ;
        $admin->password = Hash::make($request->input('password')) ;
        $admin->save();
        if ($admin){
        if ( Auth::guard('admin')->attempt(['email'=>$request->input('email'),
            'password'=>$request->input('password')])){
            return redirect()->intended(route('adminIndex'));
        }
        return back()->withInput($request->only('email'));
        }
        return back()->withInput($request->only('email'));
    }

}
