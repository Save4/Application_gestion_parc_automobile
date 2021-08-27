<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Piece;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PieceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:piece-list|piece-create|piece-edit|piece-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:piece-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:piece-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:piece-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $pieces = DB::table('pieces')
            ->join('fournisseurs', 'pieces.fournisseur_id', 'fournisseurs.id')
            ->join('users', 'pieces.user_id', 'users.id')
            ->select('users.*', 'fournisseurs.*', 'pieces.*')
            ->get();
        $fournisseurs = Fournisseur::all();
        $users = User::all();
        return view('pieces.index', [
            'pieces' => $pieces,
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
        $piece = new Piece();

        $piece->fournisseur_id = $request->fournisseur_id;
        $piece->nom_piece = $request->nom_piece;
        $piece->prix_piece = $request->prix_piece;
        $piece->user_id = Auth::id();

        $piece->save();
        return redirect()->back()->with('status', 'Enregistrement reussie avec succees!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Piece  $piece
     * @return \Illuminate\Http\Response
     */
    public function show(Piece $piece)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Piece  $piece
     * @return \Illuminate\Http\Response
     */
    public function edit(Piece $piece)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Piece  $piece
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Piece $piece)
    {
        $request->validate([
            'fournisseur_id' => 'required',
            'nom_piece' => 'required',
            'prix_piece' => 'required'

        ]);

        $piece->fournisseur_id = $request->fournisseur_id;
        $piece->nom_piece = $request->nom_piece;
        $piece->prix_piece = $request->prix_piece;
        $piece->user_id = Auth::id();

        $piece->save();
        return redirect()->back()->with('status', 'Modification reussie avec succees!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Piece  $piece
     * @return \Illuminate\Http\Response
     */
    public function destroy(Piece $piece)
    {
        $piece->delete();
        return redirect()->back()->with('status', 'Suppression reussie avec succees!!!');
    }
}
