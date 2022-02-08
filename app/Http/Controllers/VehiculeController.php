<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Marque;
use App\Models\Modele;
use App\Models\Category;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VehiculeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:vehicule-list|vehicule-create|vehicule-edit|vehicule-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:vehicule-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:vehicule-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:vehicule-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicules = DB::table('vehicules')
            ->join('modeles', 'vehicules.modele_id', 'modeles.id')
            ->join('marques', 'modeles.marque_id', 'marques.id')
            ->join('users', 'vehicules.user_id', 'users.id')
            ->join('categories', 'vehicules.categorie_id', 'categories.id')
            ->select('users.*', 'marques.*', 'modeles.*', 'categories.*', 'vehicules.*')
            ->get();
        $users = User::all();
        $marques = Marque::all();
        $modeles = Modele::all();
        $categories = Category::all();
        return view('vehicules.index', [
            'vehicules' => $vehicules,
            'marques' => $marques,
            'modeles' => $modeles,
            'users' => $users,
            'categories' => $categories
        ]);
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'plaque' => ['required',  'max:255', 'string', 'unique:vehicules,plaque']
        ]);
        $vehicule = new Vehicule();

        $vehicule->modele_id = $request->modele_id;
        $vehicule->categorie_id = $request->categorie_id;
        $vehicule->transmission = $request->transmission;
        $vehicule->type_energie = $request->type_energie;
        $vehicule->plaque = $request->plaque;
        $vehicule->nombre_place = $request->nombre_place;
        $vehicule->annee_fabrication = $request->annee_fabrication;
        $vehicule->annee_sortie = $request->annee_sortie;
        $vehicule->etat = $request->etat;
        $vehicule->user_id = Auth::id();

        $vehicule->save();
        return redirect()->back()->with('status', 'Enregistrement reussie avec succees!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicule  $vehicule
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicule $vehicule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicule  $vehicule
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicule $vehicule)
    {$users = User::all();
        $marques = Marque::all();
        $modeles = Modele::all();
        $categories = Category::all();
        $vehicules = Vehicule::all();
        $vehicule = Vehicule::find($vehicule->id);
        return view('vehicules.edit', [
            'vehicule' => $vehicule,
            'marques' => $marques,
            'modeles' => $modeles,
            'users' => $users,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicule  $vehicule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicule $vehicule)
    {
         //
        $request->validate([
            'modele_id' => 'required',
            'categorie_id' => 'required',
            'transmission' => 'required',
            'type_energie' => 'required',
            'plaque' => 'required',
            'nombre_place' => 'required',
            'annee_fabrication' => 'required',
            'annee_sortie' => 'required',
            'etat' => 'required',
        ]);
        $vehicule->modele_id = $request->modele_id;
        $vehicule->categorie_id = $request->categorie_id;
        $vehicule->transmission = $request->transmission;
        $vehicule->type_energie = $request->type_energie;
        $vehicule->plaque = $request->plaque;
        $vehicule->nombre_place = $request->nombre_place;
        $vehicule->annee_fabrication = $request->annee_fabrication;
        $vehicule->annee_sortie = $request->annee_sortie;
        $vehicule->etat = $request->etat;
        $vehicule->user_id = Auth::id();

        $vehicule->save();
        return redirect('vehicules');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicule  $vehicule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicule $vehicule)
    {
        $vehicule->delete();
        return redirect('vehicules')->with('status', 'Suppression reussie avec succees!!!');
    }

    public function chargeMarque(Request $request)
    {
        if ($request->has('marque_id')) {
            $marque_id = $request->get('marque_id');
            $modeles = DB::table('marques')
                ->join('modeles', 'modeles.marque_id', 'marques.id')
                ->where('marques.id', '=', $marque_id)
                ->get();
        }
        return view('vehicules/chargeMarque', [
            'modeles' => $modeles

        ]);
    }
    public function findModele(Request $request)
    {

        $data = Modele::select('nom_modele', 'id')->where('marque_id', $request->id)->take(100)->get();
        //if our chosen id and modele table marque_id col match the get first 100 data
        //$request->id here is the id of our chosen option id
        return response()->json($data); //then sent this data to ajax success
    }
}
