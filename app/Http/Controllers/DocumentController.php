<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Marque;
use App\Models\Modele;
use App\Models\Document;
use App\Models\Vehicule;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Stroage;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:document-list|document-create|document-edit|document-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:document-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:document-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:document-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $documents = DB::table('documents')

            ->join('vehicules', 'documents.vehicule_id', 'vehicules.id')
            ->join('fournisseurs', 'documents.fournisseur_id', 'fournisseurs.id')
            ->join('users', 'documents.user_id', 'users.id')
            ->join('modeles', 'vehicules.modele_id', 'modeles.id')
            ->join('marques', 'modeles.marque_id', 'marques.id')
            ->select('users.*','fournisseurs.*', 'marques.*', 'modeles.*', 'vehicules.*', 'documents.*')
            ->get();
        $users = User::all();
        $marques = Marque::all();
        $modeles = Modele::all();
        $vehicules = Vehicule::all();
        $fournisseurs = Fournisseur::all();
        return view('documents.index', [
            'documents' => $documents,
            'vehicules' => $vehicules,
            'fournisseurs' => $fournisseurs,
            'modeles' => $modeles,
            'marques' => $marques,
            'users' => $users
        ]);
        /*
        $vehicules = Vehicule::all();
        $documents_without_paginate = Document::with(['vehicule_id'])->where('fin_validite', '>=', Carbon::now());
        $documents = Document::with(['vehicule'])->where('fin_validite', '>=', Carbon::now())->paginate(9);
        return view('documents.index', compact('vehicules', 'documents', 'documents_without_paginate'));*/
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
        /* $request->validate([
            'description' => 'required|mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf|max:2048'
            ]);
    
            $document = new Document;
            $request->validate([
                'description' => 'required|mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf|max:2048'
                ]);
        
                $document = new Document;
        
                if($request->document()) {
                    $nom_fichier = time().'_'.$request->document->getClientOriginalName();
                    $filePath = $request->document('description')->storeAs('uploads', $nom_fichier, 'public');
        
                    $document->name = time().'_'.$request->document->getClientOriginalName();
                    $document->file = '/storage/' . $filePath;
                    $document->save();
        
                    return back()
                    ->with('success','File has uploaded to the database.')
                    ->with('description', $nom_fichier);
                }
            if($request->document()) {
                $nom_fichier = time().'_'.$request->document->getClientOriginalName();
                $filePath = $request->document('description')->storeAs('uploads', $nom_fichier, 'public');
    
                $document->nom_fichier = time().'_'.$request->document->getClientOriginalName();
                $document->description = '/storage/' . $filePath;
                $document->save();
    
                return back()
                ->with('success','File has uploaded to the database.')
                ->with('description', $nom_fichier);
            }
            */
    }
    public function fileUploadPost(Request $request)
    {
        /*$request->validate([
            'file' => 'required|mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf|max:2048',
        ]);

        $fileName = time() . '.' . $request->file->extension();

        $request->file->move(public_path('uploads'), $fileName);*/

        $document = new document();
        $file = $request->file;
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $request->file->move('assets', $filename);

        $document->file = $filename;
        $document->vehicule_id = $request->vehicule_id;
        $document->fileName = $request->fileName;
        $document->fournisseur_id = $request->fournisseur_id;
        $document->debut_validite = $request->debut_validite;
        $document->fin_validite = $request->fin_validite;
        $document->prix = $request->prix;
        $document->user_id = Auth::id();

        $document->save();


        return back()
            ->with('success', 'You have successfully upload file.')
            ->with('file', $filename);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $documents = DB::table('documents')

            ->join('vehicules', 'documents.vehicule_id', 'vehicules.id')
            ->join('fournisseurs', 'documents.fournisseur_id', 'fournisseurs.id')
            ->join('users', 'documents.user_id', 'users.id')
            ->join('modeles', 'vehicules.modele_id', 'modeles.id')
            ->join('marques', 'modeles.marque_id', 'marques.id')
            ->select('users.*', 'fournisseurs.*', 'marques.*', 'modeles.*', 'vehicules.*', 'documents.*')
            ->get();
        $marques = Marque::all();
        $modeles = Modele::all();
        $users = User::all();
        $vehicules = Vehicule::all();
        $fournisseurs = Fournisseur::all();
        return view('documents.show', [
            'documents' => $documents,
            'vehicules' => $vehicules,
            'fournisseurs' => $fournisseurs,
            'users' => $users,
            'modeles' => $modeles,
            'marques' => $marques,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        //
    }
    public function findEtat(Request $request)
    {
        $data = Vehicule::select('etat')->where('id', $request->id)->first();
        //it will get etat if its id match with vehicule id
        return response()->json($data);
    }

    public function telecharger(Request $request, $file)
    {
        return response()->telecharger(public_path('assets/' . $file)); //
    }

    public function voir($id)
    {
        $document = Document::find($id);
        return view('voirdocument', compact('document'));
    }
}
