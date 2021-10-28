<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Chauffeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ChauffeurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:chauffeur-list|chauffeur-create|chauffeur-edit|chauffeur-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:chauffeur-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:chauffeur-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:chauffeur-delete', ['only' => ['destroy']]);
    }
    public function index()
    {

        $chauffeurs = DB::table('chauffeurs')
            ->join('users', 'chauffeurs.user_id', 'users.id')
            ->select('users.*', 'chauffeurs.*')
            ->get();
        $users = User::all();
        return view('chauffeurs.index', [
            'chauffeurs' => $chauffeurs,
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
            'nume_permis_conduire' => ['required',  'max:255', 'string', 'unique:chauffeurs,nume_permis_conduire']
        ]);
        $chauffeur = new Chauffeur();
        $chauffeur->nom_chauf = $request->nom_chauf;
        $chauffeur->prenom_chauf = $request->prenom_chauf;
        $chauffeur->nume_permis_conduire = $request->nume_permis_conduire;
        $chauffeur->user_id = Auth::id();

        $chauffeur->save();
        return redirect()->back()->with('status', 'Enregistrement reussie avec succees!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chauffeur  $chauffeur
     * @return \Illuminate\Http\Response
     */
    public function show(Chauffeur $chauffeur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chauffeur  $chauffeur
     * @return \Illuminate\Http\Response
     */
    public function edit(Chauffeur $chauffeur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chauffeur  $chauffeur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chauffeur $chauffeur)
    {
        // $request->validate([
        //     'nume_permis_conduire' => ['required',  'max:255', 'string', 'unique:chauffeurs,nume_permis_conduire']
        // ]);
        $chauffeur->nom_chauf = $request->nom_chauf;
        $chauffeur->prenom_chauf = $request->prenom_chauf;
        $chauffeur->nume_permis_conduire = $request->nume_permis_conduire;
        $chauffeur->user_id = Auth::id();

        $chauffeur->save();
        return redirect()->back()->with('status', 'Modification reussie avec succees!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chauffeur  $chauffeur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chauffeur $chauffeur)
    {
        $chauffeur->delete();
        return redirect()->back()->with('status', 'Suppression reussie avec succees!!!');
    }
}
