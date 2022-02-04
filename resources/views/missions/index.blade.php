@extends('layouts.layout')
@section('content')
@section('title', 'Mission | ' . config('app.name'))

<div class="container-fluid">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-head">
                        <h4 style="float: left">Ajouter la mission</h4>
                        <a href="" style="float: right" class="btn btn-primary" data-toggle="modal"
                            data-target="#addmission">
                            <i class="fa fa-plus"></i>Ajouter la mission</a>
                    </div>
                    @error('type_mission')
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <div class="alert-icon">
                                <i class="icon-close"></i>
                            </div>
                            <div class="alert-message">
                                <span> {{ $message }}</span>
                            </div>
                        </div>
                    @enderror
                    <div class="col-xs-12">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered dataTable table-responsive" id="example" role="grid"
                            aria-describedby="example_info">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Plaque</th>
                                    <th>Departement</th>
                                    <th>Chauffeur</th>
                                    <th>Mission</th>
                                    <th>Date de debut</th>
                                    <th>Date de fin</th>
                                    <th>Etat du mission</th>
                                    <th>Etat du vehicule</th>
                                    <th>Utitisateur</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($missions as $key => $mission)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $mission->plaque }}</td>
                                        <td>{{ $mission->nom_departement }}</td>
                                        <td>{{ $mission->nom_chauf }} {{ $mission->prenom_chauf }}</td>
                                        <td>{{ $mission->type_mission }}</td>
                                        <td>{{ $mission->date_debut }}</td>
                                        <td>{{ $mission->date_fin }}</td>
                                        <td>{{ $mission->etat_mission }}</td>
                                        <td>{{ $mission->etat }}</td>
                                        <td>{{ $mission->name }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="" class="btn btn-sm btn-info" data-toggle="modal"
                                                    data-target="#editmission{{ $mission->id }}"><i
                                                        class="fa fa-edit"></i>Edit</a>
                                                {{-- <a href="" class="btn btn-sm btn-danger" data-toggle="modal"
                                                    data-target="#deletemission{{ $mission->id }}"><i
                                                        class="fa fa-trash"></i>Delete</a> --}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal of adding product -->
<div class="modal right fade" id="addmission" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="staticBackdropLabel">Ajouter la mission</h4>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('missions.store') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="vehicule_id" class="form-control-label">Plaque du vehicule</label>
                            <select class="form-control" id="vehi_id" name="vehicule_id">
                                <option>Choisir la plaque</option>
                                @foreach ($vehicules as $vehicule)
                                    <option value="{{ $vehicule->id }}">
                                        {{ $vehicule->plaque }}</option>
                                @endforeach
                                @error('vehicule_id')
                                    <div class="alert alert-danger">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-control-label">Etat du vehicule</label>
                            <input id="etat" type="text" placeholder="Autochargement de l'etat"
                                class="form-control form-control-sm" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="input-27">Chauffeur</label>
                            <select name="chauffeur_id" id="chauffeur_id" class="select2_single form-control"
                                tabindex="-1" class="@error('chauffeur_id') is-invalid @enderror">
                                <option value="0" disabled="true" selected="true">Selectionner le chauffeur</option>
                                @foreach ($chauffeurs as $chauffeur)
                                    <option value="{{ $chauffeur->id }}">
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
                                    <option value="{{ $departement->id }}">
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
                                placeholder="Entre votre mission" value="">
                            @error('type_mission')
                                <button class="btn-danger">{{ $message }}</button>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input-27">Etat de la mission</label>
                            <select name="etat_mission" id="" class="form-control">
                                <option>Selectionner l'etat de la mission</option>
                                <option>En cours</option>
                                <option>Suspendu</option>
                                <option>Terminer</option>
                                <option>Parking</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="input-28">Date de debut</label>
                            <input type="date" name="date_debut" id="first-name" required="required"
                                class="form-control " class="@error('date_debut') is-invalid @enderror" placeholder=""
                                value="">
                            @error('date_debut')
                                <button class="btn-danger">{{ $message }}</button>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input-28">Date de fin</label>
                            <input type="date" name="date_fin" id="first-name" required="required"
                                class="form-control " class="@error('date_fin') is-invalid @enderror" placeholder=""
                                value="">
                            @error('date_fin')
                                <button class="btn-danger">{{ $message }}</button>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="" name="" id="" class="btn btn-primary btn-block">Enregistre</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- modal of edit product-->

<div class="modal right fade" id="editmission{{ $mission->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="staticBackdropLabel">Modifier la mission</h4>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('missions.update', $mission->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="input-27">Plaque</label>
                            <select name="vehicule_id" id="vehicule_id" class="select2_single form-control"
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
                            <label for="input-27">Etat du vehicule</label>
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
                        <button class="btn btn-warning btn-block">Modifier</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- modal of delete product-->

<div class="modal right fade" id="deletemission{{ $mission->id }}" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="staticBackdropLabel">Supprimer la mission</h4>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('missions.destroy', $mission->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <p>Tu es sur de vouloir supprimer {{ $mission->type_mission }} ?</p>
                    <div class="modal-footer">
                        <button type="" name="" id="" class="btn btn-info" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="" id="" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
