@extends('layouts.layout')
@section('content')
@section('title', 'Mission | ' . config('app.name'))

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4 bg-primary">
        <h1 class="h3 mb-2 text-gray-800" style="float: left">Modifier une mission</h1>
        <!--<button type="submit" class="btn btn-dark btn-sm" style="float: right">Cr&eacute;er</button>-->
    </div>
    <div class="card shadow mb-4 border-bottom-primary">
        <div class="card-body">
            <form action="{{ route('missions.update', $mission->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="input-27">Plaque</label>
                        <select name="vehicule_id" id="vehi_mis_id" class="select2_single form-control"
                            tabindex="-1" class="@error('vehicule_id') is-invalid @enderror">
                            <option value="0" disabled="true" selected="true">Selectionner la plaque</option>
                            @foreach ($vehicules as $vehicule)
                                <option value="{{ $vehicule->id }}" {!! $mission->vehicule_id == $vehicule->id ? 'selected="selected"' : '' !!}>
                                    {{ $vehicule->plaque }}</option>
                            @endforeach
                            @error('vehicule_id')
                                <button class="btn-danger">{{ $message }}</button>
                            @enderror
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="formGroupExampleInput">Etat du vehicule</label>
                        <input id="etat" type="text" placeholder="Autochargement de l'etat" value="{{ $vehicule->etat }}"
                        class="form-control etatVehicule" readonly>
                        @error('etat')
                            <button class="btn-danger">{{ $message }}</button>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="input-27">Chauffeur</label>
                        <select name="chauffeur_id" id="chauffeur_id" class="select2_single form-control"
                            tabindex="-1" class="@error('chauffeur_id') is-invalid @enderror">
                            <option value="0" disabled="true" selected="true">Selectionner le chauffeur</option>
                            @foreach ($chauffeurs as $chauffeur)
                                <option value="{{ $chauffeur->id }}" {!! $mission->chauffeur_id == $chauffeur->id ? 'selected="selected"' : '' !!}>
                                    {{ $chauffeur->nom_chauf }} {{ $chauffeur->prenom_chauf }}</option>
                            @endforeach
                            @error('chauffeur_id')
                                <button class="btn-danger">{{ $message }}</button>
                            @enderror
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="input-27">Departement</label>
                        <select name="departement_id" id="departement_id" class="select2_single form-control"
                            tabindex="-1" class="@error('departement_id') is-invalid @enderror">
                            <option value="0" disabled="true" selected="true">Selectionner le departement</option>
                            @foreach ($departements as $departement)
                                <option value="{{ $departement->id }}" {!! $mission->departement_id == $departement->id ? 'selected="selected"' : '' !!}>
                                    {{ $departement->nom_departement }}</option>
                            @endforeach
                            @error('departement_id')
                                <button class="btn-danger">{{ $message }}</button>
                            @enderror
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="input-28">Mission</label>
                        <input type="text" name="type_mission" id="first-name" required="required"
                            class="form-control " class="@error('type_mission') is-invalid @enderror"
                            placeholder="" value="{{ $mission->type_mission }}">
                        @error('type_mission')
                            <button class="btn-danger">{{ $message }}</button>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="input-27">Etat de la mission</label>
                        <select name="etat_mission" id="" class="form-control">
                            <option>{{ $mission->etat_mission }}</option>
                            <option>En cours</option>
                            <option>Suspendu</option>
                            <option>Terminer</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="input-28">Date de debut</label>
                        <input type="date" name="date_debut" id="first-name" required="required"
                            class="form-control " class="@error('date_debut') is-invalid @enderror" placeholder=""
                            value="{{ $mission->date_debut }}">
                        @error('date_debut')
                            <button class="btn-danger">{{ $message }}</button>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="input-28">Date de fin</label>
                        <input type="date" name="date_fin" id="first-name" required="required"
                            class="form-control " class="@error('date_fin') is-invalid @enderror" placeholder=""
                            value="{{ $mission->date_fin }}">
                        @error('date_fin')
                            <button class="btn-danger">{{ $message }}</button>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button href="{{ url('missions') }} type="submit" class="btn btn-primary shadow-primary m-1"><i class="fa fa-backward"></i>
                                ABANDONNER LA MODIFICATION</button>
                    <button type="submit" onclick="return confirm('Voulez vous modifier le mission ?')"
                             class="btn btn-success shadow-success m-1"><i
                                    class="fa fa-check-square-o"></i>
                                CONFIRMER LA MODIFICATION</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection