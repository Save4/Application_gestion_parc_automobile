@extends('layouts.layout')
@section('content')
@section('title', 'Carburant | ' . config('app.name'))

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-head">
                            <h4 style="float: left">Ajouter le carburant</h4>
                            <a href="" style="float: right" class="btn btn-primary" data-toggle="modal"
                                data-target="#addcarburant">
                                <i class="fa fa-plus"></i>Ajouter le carburant</a>
                        </div>
                        @error('type_carburant')
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
                                        <th>Mission</th>
                                        <th>Carburant</th>
                                        <th>Quantite</th>
                                        <th>Prix unitaire</th>
                                        <th>Prix total</th>
                                        <th>Distance</th>
                                        <th>Km/L</th>
                                        <th>Date de consommation</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carburants as $key => $carburant)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $carburant->plaque }}</td>
                                            <td>{{ $carburant->type_mission }}</td>
                                            <td>{{ $carburant->type_carburant }}</td>
                                            <td>{{ number_format($carburant->quantite, 2) }}L</td>
                                            <td>{{ number_format($carburant->prix_unitaire, 0) }}FraBu</td>
                                            <td>{{ number_format($carburant->prix_total, 0) }}FraBu</td>
                                            <td>{{ number_format($carburant->distance, 2) }}L</td>
                                            <td>{{ number_format($carburant->distance_littre, 2) }}Km/L</td>
                                            <td>{{ $carburant->date_conso }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="" data-toggle="modal"
                                                        data-target="#editcarburant{{ $carburant->id }}"><i
                                                            class="fa fa-edit" title="Edit"></i></a>
                                                    <a href="" data-toggle="modal"
                                                        data-target="#deletecarburant{{ $carburant->id }}"><i
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
    <div class="modal right fade" id="addcarburant" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="staticBackdropLabel">Ajouter le carburant</h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('carburants.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="input-27">Plaque</label>
                                <select name="vehicule_id" id="vehicul_id" class="form-control vehicul_id">
                                    <option value="0" disabled="true" selected="true">Selectionner la plaque</option>
                                    @foreach ($vehicules as $vehicule)
                                        <option value="{{ $vehicule->id }}">{{ $vehicule->plaque }} est
                                            {{ $vehicule->etat }}</option>
                                    @endforeach
                                    @error('vehicule_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input-28">Mission</label>
                                <select name="mission_id" id="missio_id" class="form-control missio_id" tabindex="-1"
                                    class="@error('mission_id') is-invalid @enderror">
                                    <option value="0" disabled="true" selected="true">Selectionner la mission</option>

                                    @error('mission_id')
                                        <button class="btn-danger">{{ $message }}</button>
                                    @enderror
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col col-md-6 form-group">
                            <label class="form-control-label">Etat de la mission</label>
                            <input type="text" placeholder="Autochargement de l'etat"
                                class="form-control form-control-sm etat_mission" disabled id="etat_mission">
                        </div>
                        </div>
                        {{-- <div class="form-row">
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
                        </div> --}}
                        <div class="modal-footer">
                            <button type="" name="" id="" class="btn btn-primary btn-block">Enregistre</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- modal of edit product-->

    {{-- <div class="modal right fade" id="editvehicule{{ $vehicule->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
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
    </div> --}}
@endsection
