<?php

namespace App\Http\Controllers;

use App\Medecin;
use App\Planning;
use App\Specialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Psy\Util\Json;

class PlanningsController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:structure,auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
//     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function index()
    {
          if (request()->json()){
              //dd(Planning::with('medecin')->get());
              return response()->json(Planning::with('medecin')->get());

          }
        return view('plannings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        //dd($request->all());
       // dd($request->input('date'));

        $planning = new Planning();
        $planning->idMedecin = $request->input('idMedecin');
        $planning->date = date('Y-m-d H:i:s',strtotime($request->input('date')));
        $planning->nbreplace = $request->input('nombrePlace');
        $planning->type = $request->input('type');
              $planning->save();
              if ($planning)
                  return response()->json('success');
              return response()->json('error');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        //dd("loser");
        $medecinId = Medecin::where('idSpecialite',$id)->value('id');
        return response()->json(Planning::where('idMedecin',$medecinId)->with('medecin')->get());
    }

    public function medecinsList()
    {


            return response()->json(DB::table('medecins')->select('id','nom', 'prenom')->get());

    }

    public function medecinSpec($medId)
    {
        return response()->json(Medecin::find($medId)->specialte['nom']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
