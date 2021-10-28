<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mission;
use App\Models\Vehicule;
use App\Models\Carburant;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CarburantController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:carburant-list|carburant-create|carburant-edit|carburant-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:carburant-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:carburant-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:carburant-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $carburants = DB::table('carburants')
            ->join('missions', 'carburants.mission_id', 'missions.id')
            ->join('fournisseurs', 'carburants.fournisseur_id', 'fournisseurs.id')
            ->join('vehicules', 'missions.vehicule_id', 'vehicules.id')
            ->join('users', 'carburants.user_id', 'users.id')
            ->select('fournisseurs.*','users.*', 'vehicules.*', 'missions.*', 'carburants.*')
            ->get();
        $fournisseurs = Fournisseur::all();
        $missions = Mission::all();
        $vehicules = Vehicule::all();
        $users = User::all();
        return view('carburants.index', [
            'carburants' => $carburants,
            'missions' => $missions,
            'vehicules' => $vehicules,
            'fournisseurs' => $fournisseurs,
            'users' => $users
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $carburant = new Carburant();

        $carburant->fournisseur_id = $request->fournisseur_id;
        $carburant->mission_id = $request->mission_id;
        $carburant->type_carburant = $request->type_carburant;
        $carburant->quantite = $request->quantite;
        $carburant->prix_unitaire = $request->prix_unitaire;
        $carburant->prix_total = $request->prix_total;
        $carburant->distance = $request->distance;
        $carburant->distance_littre = $request->distance_littre;
        $carburant->date_conso = $request->date_conso;
        $carburant->user_id = Auth::id();

        $carburant->save();
        return redirect()->back()->with('status', 'Enregistrement reussie avec succees!!!');
    }


    public function show(Carburant $carburant)
    {
        //
    }

    public function edit(Carburant $carburant)
    {
        //
    }


    public function update(Request $request, Carburant $carburant)
    {
        $carburant->fournisseur_id = $request->fournisseur_id;
        $carburant->mission_id = $request->mission_id;
        $carburant->type_carburant = $request->type_carburant;
        $carburant->quantite = $request->quantite;
        $carburant->prix_unitaire = $request->prix_unitaire;
        $carburant->prix_total = $request->prix_total;
        $carburant->distance = $request->distance;
        $carburant->distance_littre = $request->distance_littre;
        $carburant->date_conso = $request->date_conso;
        $carburant->user_id = Auth::id();

        $carburant->save();
        return redirect()->back()->with('status', 'Modification reussie avec succees!!!');
    }

    public function destroy(Carburant $carburant)
    {
        $carburant->delete();
        return redirect()->back()->with('status', 'Suppression reussie avec succees!!!');
    }
    public function findMission(Request $request)
    {

        $data = Mission::select('type_mission', 'id')->where('vehicule_id', $request->id)->take(100)->get();
        //if our chosen id and mission table vehicule_id col match the get first 100 data
        //$request->id here is the id of our chosen option id
        return response()->json($data); //then sent this data to ajax success
    }
    public function findEtat(Request $request)
    {
        $data = Mission::select('etat_mission')->where('id', $request->id)->first();
        //it will get etat if its id match with vehicule id
        return response()->json($data);
    }
}
