<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:fournisseur-list|fournisseur-create|fournisseur-edit|fournisseur-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:fournisseur-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:fournisseur-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:fournisseur-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $fournisseurs = DB::table('fournisseurs')
            ->join('users', 'fournisseurs.user_id', 'users.id')
            ->select('users.*', 'fournisseurs.*')
            ->get();
        $users = User::all();
        return view('fournisseurs.index', [
            'fournisseurs' => $fournisseurs,
            'users' => $users
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
            'nom_fournisseur' => ['required',  'max:255', 'string', 'unique:fournisseurs,nom_fournisseur']
        ]);
        Fournisseur::create($request->all());
        return redirect()->back()->with('status', 'Enregistrement reussie avec succees!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function show(Fournisseur $fournisseur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function edit(Fournisseur $fournisseur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fournisseur $fournisseur)
    {

        $fournisseur->update($request->all());
        return redirect()->back()->with('status', 'Modification reussie avec succees!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fournisseur $fournisseur)
    {
        $fournisseur->delete();
        return redirect()->back()->with('status', 'Suppression reussie avec succees!!!');
    }
}
