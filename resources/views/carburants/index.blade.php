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
                                        <th>Utitisateur</th>
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
                                            <td>{{ number_format($carburant->distance, 2) }}Km</td>
                                            <td>{{ number_format($carburant->distance_littre, 2) }}Km/L</td>
                                            <td>{{ $carburant->date_conso }}</td>
                                            <td>{{$carburant->name  }}
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
    <div class="modal right fade somme" id="addcarburant" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="staticBackdropLabel">Ajouter le carburant</h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body somme">
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
                            <div class="form-group col-md-6">
                                <label for="input-27">Carburant</label>
                                <select name="type_carburant" id="type_carburant" class="form-control" tabindex="-1"
                                    class="@error('type_carburant') is-invalid @enderror">
                                    <option value="0" disabled="true" selected="true">Selectionner le carburant</option>
                                    <option>Essance</option>
                                    <option>Gasoil</option>
                                    @error('type_carburant')
                                        <button class="btn-danger">{{ $message }}</button>
                                    @enderror
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="input-28">Prix unitaire en FraBu</label>
                                <input type="number" name="prix_unitaire" id="unit" required="required"
                                    class="form-control prix_unitaire" class="@error('prix_unitaire') is-invalid @enderror"
                                    placeholder="" value="">
                                @error('prix_unitaire')
                                    <button class="btn-danger">{{ $message }}</button>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input-28">Quantite en L</label>
                                <input type="number" name="quantite" id="quantit" required="required"
                                    class="form-control quantite" class="@error('quantite') is-invalid @enderror"
                                    placeholder="" value="">
                                @error('quantite')
                                    <button class="btn-danger">{{ $message }}</button>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="input-27">Prix total en FraBu</label>
                                <input type="number" name="prix_total" id="prix_total" required="required"
                                    class="form-control prix_total" class="@error('prix_total') is-invalid @enderror"
                                    placeholder="" value="" disabled>
                                @error('prix_total')
                                    <button class="btn-danger">{{ $message }}</button>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input-28">Distance parcourue en Km</label>
                                <input type="number" name="distance" id="distance" required="required" class="form-control "
                                    class="@error('distance') is-invalid @enderror" placeholder="" value="">
                                @error('distance')
                                    <button class="btn-danger">{{ $message }}</button>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="input-27">Km/L</label>
                                <input type="number" name="distance_littre" id="distance_littre" required="required"
                                    class="form-control " class="@error('distance_littre') is-invalid @enderror"
                                    placeholder="" value="" disabled>
                                @error('distance_littre')
                                    <button class="btn-danger">{{ $message }}</button>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input-28">Date de consommation</label>
                                <input type="date" name="date_conso" id="date_conso" required="required"
                                    class="form-control " class="@error('date_conso') is-invalid @enderror" placeholder=""
                                    value="">
                                @error('date_conso')
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

    <div class="modal right fade" id="editcarburant{{ $carburant->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="staticBackdropLabel">Modifier le carburant</h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('carburants.update', $carburant->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="input-27">Plaque</label>
                                <select name="vehicule_id" id="vehicul_id" class="form-control vehicul_id">
                                    @foreach ($vehicules as $vehicule)
                                        <option value="{{ $vehicule->id }}" {!! $carburant->vehicule_id == $vehicule->id ? 'selected="selected"' : '' !!}>{{ $vehicule->plaque }} est
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
                                    @foreach ($missions as $mission)
                                    <option value="{{ $mission->id }}" {!! $carburant->mission_id == $mission->id ? 'selected="selected"' : '' !!}>
                                        {{ $mission->type_mission }}</option>
                                    @endforeach
                                    @error('mission_id')
                                        <button class="btn-danger">{{ $message }}</button>
                                    @enderror
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col col-md-6 form-group">
                                <label class="form-control-label">Etat de la mission</label>
                                <input type="text" value="{{ $carburant->etat_mission }}"
                                    class="form-control form-control-sm etat_mission" disabled id="etat_mission">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input-27">Carburant</label>
                                <select name="type_carburant" id="type_carburant" class="form-control" tabindex="-1"
                                    class="@error('type_carburant') is-invalid @enderror">
                                    <option value="" disabled="true" selected="true">{{ $carburant->type_carburant  }}</option>
                                    <option>Essance</option>
                                    <option>Gasoil</option>
                                    @error('type_carburant')
                                        <button class="btn-danger">{{ $message }}</button>
                                    @enderror
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="input-28">Prix unitaire en FraBu</label>
                                <input type="number" name="prix_unitaire" id="unit" required="required"
                                    class="form-control prix_unitaire" class="@error('prix_unitaire') is-invalid @enderror"
                                    placeholder="" value="{{ $carburant->prix_unitaire  }}">
                                @error('prix_unitaire')
                                    <button class="btn-danger">{{ $message }}</button>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input-28">Quantite en L</label>
                                <input type="number" name="quantite" id="quantit" required="required"
                                    class="form-control quantite" class="@error('quantite') is-invalid @enderror"
                                    placeholder="" value="{{$carburant->quantite  }}">
                                @error('quantite')
                                    <button class="btn-danger">{{ $message }}</button>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="input-27">Prix total en FraBu</label>
                                <input type="number" name="prix_total" id="prix_total" required="required"
                                    class="form-control prix_total" class="@error('prix_total') is-invalid @enderror"
                                    placeholder="" value="{{ $carburant->prix_total }}">
                                @error('prix_total')
                                    <button class="btn-danger">{{ $message }}</button>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input-28">Distance parcourue en Km</label>
                                <input type="number" name="distance" id="distance" required="required" class="form-control "
                                    class="@error('distance') is-invalid @enderror" placeholder="" value="{{ $carburant->distance }}">
                                @error('distance')
                                    <button class="btn-danger">{{ $message }}</button>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="input-27">Km/L</label>
                                <input type="number" name="distance_littre" id="distance_littre" required="required"
                                    class="form-control " class="@error('distance_littre') is-invalid @enderror"
                                    placeholder="" value="{{ $carburant->distance_littre }}">
                                @error('distance_littre')
                                    <button class="btn-danger">{{ $message }}</button>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input-28">Date de consommation</label>
                                <input type="date" name="date_conso" id="date_conso" required="required"
                                    class="form-control " class="@error('date_conso') is-invalid @enderror" placeholder=""
                                    value="{{ $carburant->date_conso }}">
                                @error('date_conso')
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

    <div class="modal right fade" id="deletecarburant{{ $carburant->id }}" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="staticBackdropLabel">Supprimer le carburant</h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('carburants.destroy', $carburant->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <p>Tu es sur de vouloir supprimer {{ $carburant->quantite }}L d'(e) {{ $carburant->type_carburant }}
                            du vehicule de plaque {{ $carburant->plaque }} ?</p>
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
