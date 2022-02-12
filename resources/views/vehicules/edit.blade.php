@extends('layouts.layout')
@section('content')
@section('title', 'Vehicule | ' . config('app.name'))

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4 bg-primary">
        <h1 class="h3 mb-2 text-gray-800" style="float: left">Modifier un vehicule</h1>
        <!--<button type="submit" class="btn btn-dark btn-sm" style="float: right">Cr&eacute;er</button>-->
    </div>
    <div class="card shadow mb-4 border-bottom-primary">
        <div class="card-body">
            <form action="{{ route('vehicules.update', $vehicule->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="input-27">Marque</label>
                        <select name="marque_id" id="marque_id" class="form-control form-control-rounded mark_id">
                            @foreach ($marques as $marque)
                                <option value="{{ $marque->id }}" {!! $vehicule->marque_id == $marque->id ? 'selected="selected"' : '' !!}>
                                    {{ $marque->nom_marque }}</option>
                            @endforeach
                            @error('marque_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="input-28">Modele</label>
                        <select name="modele_id" id="model_id"
                            class="select2_single form-control form-control-rounded" tabindex="-1"
                            class="@error('modele_id') is-invalid @enderror">
                            @foreach ($modeles as $modele)
                                <option value="{{ $modele->id }}" {!! $vehicule->modele_id == $modele->id ? 'selected="selected"' : '' !!}>
                                    {{ $modele->nom_modele }}</option>
                            @endforeach
                            @error('modele_id')
                                <button class="btn-danger">{{ $message }}</button>
                            @enderror
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="input-27">Categorie</label>
                        <select name="categorie_id" id="categorie_id" class="select2_single form-control"
                            tabindex="-1" class="@error('categorie_id') is-invalid @enderror">
                            <option value="0" disabled="true" selected="true">Selectionner la categorie</option>
                            @foreach ($categories as $categorie)
                                <option value="{{ $categorie->id }}" {!! $vehicule->categorie_id == $categorie->id ? 'selected="selected"' : '' !!}>
                                    {{ $categorie->nom_category }}</option>
                            @endforeach
                            @error('categorie_id')
                                <button class="btn-danger">{{ $message }}</button>
                            @enderror
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="input-28">Plaque</label>
                        <input type="text" name="plaque" id="first-name" required="required" class="form-control "
                            class="@error('plaque') is-invalid @enderror" placeholder=""
                            value="{{ $vehicule->plaque }}">
                        @error('plaque')
                            <button class="btn-danger">{{ $message }}</button>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="input-27">Transmission</label>
                        <select name="transmission" id="" class="form-control">
                            <option>{{ $vehicule->transmission }}</option>
                            <option>Boite manuel</option>
                            <option>Boite automatique</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="input-28">Type d'energie</label>
                        <select name="type_energie" id="" class="form-control">
                            <option>{{ $vehicule->type_energie }}</option>
                            <option>Essance</option>
                            <option>Gasoil</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="input-27">Nombre de place</label>
                        <input type="number" name="nombre_place" id="first-name" required="required"
                            class="form-control " class="@error('nombre_place') is-invalid @enderror" placeholder=""
                            value="{{ $vehicule->nombre_place }}">
                        @error('nombre_place')
                            <button class="btn-danger">{{ $message }}</button>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="input-28">Date de fabrication</label>
                        <input type="date" name="annee_fabrication" id="first-name" required="required"
                            class="form-control " class="@error('annee_fabrication') is-invalid @enderror"
                            placeholder="" value="{{ $vehicule->annee_fabrication }}">
                        @error('annee_fabrication')
                            <button class="btn-danger">{{ $message }}</button>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="input-27">Date de sortie</label>
                        <input type="date" name="annee_sortie" id="first-name" required="required"
                            class="form-control " class="@error('annee_sortie') is-invalid @enderror" placeholder=""
                            value="{{ $vehicule->annee_sortie }}">
                        @error('annee_sortie')
                            <button class="btn-danger">{{ $message }}</button>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="input-27">Etat du vehicule</label>
                        <select name="etat" id="" class="form-control">
                            <option>{{ $vehicule->etat }}</option>
                            <option>Actif</option>
                            <option>En garrage</option>
                            <option>Suspendu</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button href="{{ url('vehicules') }} type="submit" class="btn btn-primary shadow-primary m-1"><i class="fa fa-backward"></i>
                                ABANDONNER LA MODIFICATION</button>
                    <button type="submit" onclick="return confirm('Voulez vous modifier le vehicule ?')"
                             class="btn btn-success shadow-success m-1"><i
                                    class="fa fa-check-square-o"></i>
                                CONFIRMER LA MODIFICATION</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection