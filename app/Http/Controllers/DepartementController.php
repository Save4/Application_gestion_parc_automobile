<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ function __construct()
    {
        $this->middleware('permission:departement-list|departement-create|departement-edit|departement-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:departement-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:departement-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:departement-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $departements = DB::table('departements')
            ->join('users', 'departements.user_id', 'users.id')
            ->select('users.*', 'departements.*')
            ->get();
        $users = User::all();
        return view('departements.index', [
            'departements' => $departements,
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
            'nom_departement' => ['required',  'max:255', 'string', 'unique:departements,nom_departement']
        ]);
        Departement::create($request->all());
        return redirect()->back()->with('status', 'Enregistrement reussie avec succees!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function show(Departement $departement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function edit(Departement $departement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Departement $departement)
    {
        $request->validate([
            'nom_departement' => ['required',  'max:255', 'string', 'unique:departements,nom_departement']
        ]);
        $departement->update($request->all());
        return redirect()->back()->with('status', 'Modification reussie avec succees!!!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Departement  $departement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departement $departement)
    {
        $departement->delete();
        return redirect()->back()->with('status', 'Suppression reussie avec succees!!!');
    }
}
