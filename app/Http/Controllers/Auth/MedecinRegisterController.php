<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Medecin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MedecinRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware("guest:medecin");
    }
    public function showRegisterForm(){

        return view("auth.medecin.register");
    }
    protected function validator(array $data)
    {
        //  id	nom	prenom	username	email	password	img	idSpecialite	idStructure
        return Validator::make($data, [
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:medecins'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:medecins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'idSpecialite' => ['required', 'numeric'],
            'idStructure' => ['required', 'numeric'],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  Request  $request
     * @return Medecin
     */
    protected function register(Request $request)
    {
        $medecin = new Medecin();
        $medecin->nom = $request->input('nom') ;
        $medecin->prenom = $request->input('prenom') ;
        $medecin->username = $request->input('username') ;
        $medecin->email = $request->input('email') ;
        $medecin->password = Hash::make($request->input('password')) ;
        $medecin->idSpecialite = $request->input('idSpecialite') ;
        $medecin->idStructure = $request->input('idStructure') ;
        $medecin->save();
        if ($medecin){
        if ( Auth::guard('medecin')->attempt(['email'=>$request->input('email'),
            'password'=>$request->input('password')])){
            return redirect()->intended(route('medecinIndex'));
        }
        return back()->withInput($request->only('email'));
        }
        return back()->withInput($request->only('email'));
    }

}
