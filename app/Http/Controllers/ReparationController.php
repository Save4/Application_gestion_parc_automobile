<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Piece;
use App\Models\Marque;
use App\Models\Modele;
use App\Models\Vehicule;
use App\Models\Reparation;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReparationController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:reparation-list|reparation-create|reparation-edit|reparation-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:reparation-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:reparation-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:reparation-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $reparations = DB::table('reparations')
            ->join('pieces', 'reparations.piece_id', 'pieces.id')
            ->join('vehicules', 'reparations.vehicule_id', 'vehicules.id')
            ->join('fournisseurs', 'reparations.fournisseur_id', 'fournisseurs.id')
            ->join('modeles', 'vehicules.modele_id', 'modeles.id')
            ->join('marques', 'modeles.marque_id', 'marques.id')
            ->join('users', 'reparations.user_id', 'users.id')
            ->select('fournisseurs.*','marques.*','modeles.*','pieces.*', 'users.*', 'vehicules.*', 'reparations.*')
            ->get();
        $pieces = Piece::all();
        $users = User::all();
        $vehicules = Vehicule::all();
        $modeles = Modele::all();
        $marques = Marque::all();
        $fournisseurs = Fournisseur::all();
        return view('reparations.index', [
            'vehicules' => $vehicules,
            'pieces' => $pieces,
            'modeles' => $modeles,
            'marques' => $marques,
            'users' => $users,
            'fournisseurs' => $fournisseurs,
            'reparations' => $reparations
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
        for ($piece_id = 0; $piece_id < count($request->piece_id); $piece_id++) {
            $reparation = new Reparation;
            $reparation->piece_id = $request->piece_id[$piece_id];
            $reparation->vehicule_id = $request->vehicule_id[$piece_id];
            $reparation->fournisseur_id = $request->fournisseur_id[$piece_id];
            $reparation->type_panne = $request->type_panne[$piece_id];
            $reparation->nombre = $request->nombre[$piece_id];
            $reparation->prix_toto_piece = $request->prix_toto_piece[$piece_id];
            $reparation->main_oeuvre = $request->main_oeuvre[$piece_id];
            $reparation->toto_conso = $request->toto_conso[$piece_id];
            $reparation->user_id = auth()->user()->id;
            $reparation->save();
        }
        return redirect()->back()->with('status', 'Enregistrement reussie avec succees!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reparation  $reparation
     * @return \Illuminate\Http\Response
     */
    public function show(Reparation $reparation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reparation  $reparation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reparation $reparation)
    {
        $pieces = Piece::all();
        $users = User::all();
        $vehicules = Vehicule::all();
        $modeles = Modele::all();
        $marques = Marque::all();
        $reparation = Reparation::find($reparation->id);
        return view('reparations.edit',[
            'vehicules' => $vehicules,
            'pieces' => $pieces,
            'modeles' => $modeles,
            'marques' => $marques,
            'users' => $users,
            'reparation' => $reparation
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reparation  $reparation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reparation $reparation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reparation  $reparation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reparation $reparation)
    {
        //
    }
}
