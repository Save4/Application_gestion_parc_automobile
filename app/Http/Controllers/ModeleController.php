<?php

namespace App\Http\Controllers;

use App\Models\Marque;
use App\Models\Modele;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModeleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:modele-list|modele-create|modele-edit|modele-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:modele-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:modele-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:modele-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modeles = DB::table('modeles')
            ->join('marques', 'modeles.marque_id', 'marques.id')
            ->select('marques.*', 'modeles.*')
            ->get();
        $marques = Marque::all();
        return view('modeles.index', [
            'modeles' => $modeles,
            'marques' => $marques
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
        Modele::create($request->all());
        return redirect()->back()->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Modele  $modele
     * @return \Illuminate\Http\Response
     */
    public function show(Modele $modele)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Modele  $modele
     * @return \Illuminate\Http\Response
     */
    public function edit(Modele $modele)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Modele  $modele
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Modele $modele)
    {
        $modele->update($request->all());
        return redirect()->back()->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Modele  $modele
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modele $modele)
    {
        $modele->delete();
        return redirect()->back()->with('success', 'Product deleted successfully');
    }
}