<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use App\Models\Carburant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            ->join('vehicules', 'carburants.vehicule_id', 'vehicules.id')
            ->select('vehicules.*', 'carburants.*')
            ->get();
        $vehicules = Vehicule::all();
        return view('carburants.index', [
            'carburants' => $carburants,
            'vehicules' => $vehicules
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        Carburant::create($request->all());
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
        $carburant->update($request->all());
        return redirect()->back()->with('status', 'Modification reussie avec succees!!!');
    }

    public function destroy(Carburant $carburant)
    {
        $carburant->delete();
        return redirect()->back()->with('status','Suppression reussie avec succees!!!');
    }
}

