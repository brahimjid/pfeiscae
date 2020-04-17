<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Structure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StructureRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware("guest:structure");
    }
    public function showRegisterForm(){

        return view("auth.structure.register");
    }
    protected function validator(array $data)
    {
        //  id	nom	prenom	username	email	password	img	idSpecialite	idStructure
        return Validator::make($data, [
            'nom' => ['required', 'string', 'max:255'],
            'tel' => ['required', 'string', 'max:255'],
            'adresse' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:structures'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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
        $structure = new Structure();
        $structure->nom = $request->input('nom') ;
        $structure->adresse = $request->input('adresse') ;
        $structure->tel = $request->input('tel') ;
        $structure->email = $request->input('email') ;
        $structure->password = Hash::make($request->input('password')) ;
        $structure->save();
        if ($structure){
            if ( Auth::guard('structure')->attempt(['email'=>$request->input('email'),
                'password'=>$request->input('password')])){
                return redirect()->intended(route('structureIndex'));
            }
            return back()->withInput($request->only('email'));
        }
        return back()->withInput($request->only('email'));
    }
}
