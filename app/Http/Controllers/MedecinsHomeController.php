<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MedecinsHomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:medecin');
    }
    public function index()
    {
        return view('auth.medecin.index');
    }
}
