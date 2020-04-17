<?php

namespace App\Http\Controllers;

use App\Specialite;
use Illuminate\Http\Request;

class StructuresHomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:structure');
    }
    public function index()
    {
        $specialites = Specialite::all();
        return view('auth.structure.index',compact('specialites'));
    }
}
