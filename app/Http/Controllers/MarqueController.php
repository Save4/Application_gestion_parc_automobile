<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Marque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarqueController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:marque-list|marque-create|marque-edit|marque-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:marque-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:marque-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:marque-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marques = DB::table('marques')
            ->join('users', 'marques.user_id', 'users.id')
            ->select('users.*', 'marques.*')
            ->get();
        $users = User::all();
        return view('marques.index', [
            'marques' => $marques,
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
            'nom_marque' => ['required',  'max:255', 'string', 'unique:marques,nom_marque']
        ]);
        Marque::create($request->all());
        return redirect()->back()->with('status', 'Enregistrement reussie avec succees!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marque  $marque
     * @return \Illuminate\Http\Response
     */
    public function show(Marque $marque)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marque  $marque
     * @return \Illuminate\Http\Response
     */
    public function edit(Marque $marque)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marque  $marque
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marque $marque)
    {
        $request->validate([
            'nom_marque' => ['required',  'max:255', 'string', 'unique:marques,nom_marque']
        ]);
        $marque->update($request->all());
        return redirect()->back()->with('status', 'Modification reussie avec succees!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marque  $marque
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marque $marque)
    {
        $marque->delete();
        return redirect()->back()->with('status','Suppression reussie avec succees!!!');
    }
}
