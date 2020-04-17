<?php

namespace App\Http\Controllers;
use App\Medecin;
use Illuminate\Http\Request;

class MedecinsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:medecin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('auth.medecin.index');
    }
}
