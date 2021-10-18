@extends('layouts.layout')
@section('content')
@section('title', 'Vehicule | ' . config('app.name'))

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-head">
                            <h4 style="float: left">Ajouter le vehicule</h4>
                            <a href="" style="float: right" class="btn btn-primary" data-toggle="modal"
                                data-target="#addvehicule">
                                <i class="fa fa-plus"></i>Ajouter le vehicule</a>
                        </div>
                        @error('plaque')
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
                            <table id="default-datatable" class="table table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Marque</th>
                                        <th>Modele</th>
                                        <th>Categorie</th>
                                        <th>Transmission</th>
                                        <th>Type d'energie</th>
                                        <th>Plaque</th>
                                        <th>Place</th>
                                        <th>Date de fabrication</th>
                                        <th>Date de sortie</th>
                                        <th>Etat du vehicule</th>
                                        <th>Utitisateur</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vehicules as $key => $vehicule)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $vehicule->nom_marque }}</td>
                                            <td>{{ $vehicule->nom_modele }}</td>
                                            <td>{{ $vehicule->nom_category }}</td>
                                            <td>{{ $vehicule->transmission }}</td>
                                            <td>{{ $vehicule->type_energie }}</td>
                                            <td>{{ $vehicule->plaque }}</td>
                                            <td>{{ $vehicule->nombre_place }}</td>
                                            <td>{{ $vehicule->annee_fabrication }}</td>
                                            <td>{{ $vehicule->annee_sortie }}</td>
                                            <td>{{ $vehicule->etat }}</td>
                                            <td>{{ $vehicule->name }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="" data-toggle="modal"
                                                        data-target="#editvehicule{{ $vehicule->id }}"><i
                                                            class="fa fa-edit" title="Edit"></i></a>
                                                    <a href="" data-toggle="modal"
                                                        data-target="#deletevehicule{{ $vehicule->id }}"><i
                                                            class="fa fa-trash" title="Delete"></i></a>
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
    <div class="modal right fade" id="addvehicule" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="staticBackdropLabel">Ajouter le vehicule</h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('vehicules.store') }}" method="POST">
                        @csrf
                        <div class="form-row addMarque">
                            <div class="form-group col-md-6">
                                <label for="input-27">Marque</label>
                                <select name="marque_id" id="mark_id" class="form-control mark_id">
                                    <option value="0" disabled="true" selected="true">Selectionner la marque</option>
                                    @foreach ($marques as $marque)
                                        <option value="{{ $marque->id }}">{{ $marque->nom_marque }}</option>
                                    @endforeach
                                    @error('marque_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input-28">Modele</label>
                                <select name="modele_id" id="model_id" class="form-control model_id" tabindex="-1"
                                    class="@error('modele_id') is-invalid @enderror">
                                    <option value="0" disabled="true" selected="true">Selectionner le modele</option>
                                    
                                    @error('modele_id')
                                        <button class="btn-danger">{{ $message }}</button>
                                    @enderror
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="input-27">Categorie</label>
                                <select name="categorie_id" id="categorie_id" class="form-control" tabindex="-1"
                                    class="@error('categorie_id') is-invalid @enderror">
                                    <option value="0" disabled="true" selected="true">Selectionner la categorie</option>
                                    @foreach ($categories as $categorie)
                                        <option value="{{ $categorie->id }}">{{ $categorie->nom_category }}</option>
                                    @endforeach
                                    @error('categorie_id')
                                        <button class="btn-danger">{{ $message }}</button>
                                    @enderror
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input-28">Plaque</label>
                                <input type="text" name="plaque" id="first-name" required="required" class="form-control "
                                    class="@error('plaque') is-invalid @enderror" placeholder="Entre la plaque" value="">
                                @error('plaque')
                                    <button class="btn-danger">{{ $message }}</button>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="input-27">Transmission</label>
                                <select name="transmission" id="" class="form-control">
                                    <option value="0" disabled="true" selected="true">Selectionner la boite de vitesse
                                    </option>
                                    <option>Boite manuel</option>
                                    <option>Boite automatique</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input-28">Type d'energie</label>
                                <select name="type_energie" id="" class="form-control">
                                    <option value="0" disabled="true" selected="true">Selectionner le type d'energie
                                    </option>
                                    <option>Essance</option>
                                    <option>Gasoil</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="input-27">Nombre de place</label>
                                <input type="number" name="nombre_place" id="first-name" required="required"
                                    class="form-control " class="@error('nombre_place') is-invalid @enderror"
                                    placeholder="Entre le nombre de place" value="">
                                @error('nombre_place')
                                    <button class="btn-danger">{{ $message }}</button>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input-28">Date de fabrication</label>
                                <input type="date" name="annee_fabrication" id="first-name" required="required"
                                    class="form-control " class="@error('annee_fabrication') is-invalid @enderror"
                                    placeholder="" value="">
                                @error('annee_fabrication')
                                    <button class="btn-danger">{{ $message }}</button>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="input-27">Date de sortie</label>
                                <input type="date" name="annee_sortie" id="first-name" required="required"
                                    class="form-control " class="@error('annee_sortie') is-invalid @enderror" placeholder=""
                                    value="">
                                @error('annee_sortie')
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

    <div class="modal right fade" id="editvehicule{{ $vehicule->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="staticBackdropLabel">Modifier le vehicule</h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('vehicules.update', $vehicule->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-row">
                            <div class="form-group col-md-6">
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
                            <div class="form-group col-md-6">
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
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
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
                            <div class="form-group col-md-6">
                                <label for="input-28">Plaque</label>
                                <input type="text" name="plaque" id="first-name" required="required" class="form-control "
                                    class="@error('plaque') is-invalid @enderror" placeholder=""
                                    value="{{ $vehicule->plaque }}">
                                @error('plaque')
                                    <button class="btn-danger">{{ $message }}</button>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="input-27">Transmission</label>
                                <select name="transmission" id="" class="form-control">
                                    <option>{{ $vehicule->transmission }}</option>
                                    <option>Boite manuel</option>
                                    <option>Boite automatique</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input-28">Type d'energie</label>
                                <select name="type_energie" id="" class="form-control">
                                    <option>{{ $vehicule->type_energie }}</option>
                                    <option>Essance</option>
                                    <option>Gasoil</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="input-27">Nombre de place</label>
                                <input type="number" name="nombre_place" id="first-name" required="required"
                                    class="form-control " class="@error('nombre_place') is-invalid @enderror" placeholder=""
                                    value="{{ $vehicule->nombre_place }}">
                                @error('nombre_place')
                                    <button class="btn-danger">{{ $message }}</button>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input-28">Date de fabrication</label>
                                <input type="date" name="annee_fabrication" id="first-name" required="required"
                                    class="form-control " class="@error('annee_fabrication') is-invalid @enderror"
                                    placeholder="" value="{{ $vehicule->annee_fabrication }}">
                                @error('annee_fabrication')
                                    <button class="btn-danger">{{ $message }}</button>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="input-27">Date de sortie</label>
                                <input type="date" name="annee_sortie" id="first-name" required="required"
                                    class="form-control " class="@error('annee_sortie') is-invalid @enderror" placeholder=""
                                    value="{{ $vehicule->annee_sortie }}">
                                @error('annee_sortie')
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

    <div class="modal right fade" id="deletevehicule{{ $vehicule->id }}" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="staticBackdropLabel">Supprimer le vehicule</h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('vehicules.destroy', $vehicule->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <p>Tu es sur de vouloir supprimer {{ $vehicule->plaque }} ?</p>
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
