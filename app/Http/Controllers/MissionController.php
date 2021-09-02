<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\Vehicule;
use App\Models\Chauffeur;
use App\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MissionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:mission-list|mission-create|mission-edit|mission-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:mission-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:mission-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:mission-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $missions = DB::table('missions')
            ->join('vehicules', 'missions.vehicule_id', 'vehicules.id')
            ->join('departements', 'missions.departement_id', 'departements.id')
            ->join('chauffeurs', 'missions.chauffeur_id', 'chauffeurs.id')
            ->select('vehicules.*', 'departements.*', 'chauffeurs.*',  'missions.*')
            ->get();
        $vehicules = Vehicule::all();
        $departements = Departement::all();
        $chauffeurs = Chauffeur::all();
        return view('missions.index', [
            'missions' => $missions,
            'vehicules' => $vehicules,
            'departements' => $departements,
            'chauffeurs' => $chauffeurs
        ]);
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        Mission::create($request->all());
        return redirect()->back()->with('status', 'Enregistrement reussie avec succees!!!');
    }

    public function show(Mission $mission)
    {
        //
    }

    public function edit(Mission $mission)
    {
        //
    }

    public function update(Request $request, Mission $mission)
    {
        $mission->update($request->all());
        return redirect()->back()->with('status', 'Modification reussie avec succees!!!');
    }


    public function destroy(Mission $mission)
    {
        $mission->delete();
        return redirect()->back()->with('status', 'Suppression reussie avec succees!!!');
    }

    public function findEtat(Request $request)
    {
        $data = Vehicule::select('etat')->where('id', $request->id)->first();
        //it will get etat if its id match with vehicule id
        return response()->json($data);
    }
}
