@extends('layouts.layout')
@section('content')
@section('title', 'Carburant | ' . config('app.name'))

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4 bg-primary">
        <h1 class="h3 mb-2 text-gray-800" style="float: left">Modifier la cosommation du carburent</h1>
        <!--<button type="submit" class="btn btn-dark btn-sm" style="float: right">Cr&eacute;er</button>-->
    </div>
    <div class="card shadow mb-4 border-bottom-primary">
        <div class="card-body">
            <form action="{{ route('carburants.update', $carburant->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="vehicule_id" class="form-control-label">Plaque du vehicule</label>
                        <select class="form-control vehi_mis" id="vehi_mis_id" name="vehicule_id">
                            @foreach ($vehicules as $vehicule)
                            <option value="{{ $vehicule->id }}" {!! $carburant->vehicule_id == $vehicule->id ? 'selected="selected"' : '' !!}>
                                    {{ $vehicule->plaque }}</option>
                            @endforeach
                            @error('vehicule_id')
                                <div class="alert alert-danger">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="formGroupExampleInput">Etat du vehicule</label>
                        <input id="etat" type="text" placeholder="Autochargement de l'etat"
                            class="form-control etatVehicule" value="{{ $vehicule->etat }}" disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="input-28">Mission</label>
                        <select name="mission_id" id="missio_id" class="form-control mission" tabindex="-1"
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
                    <div class="col col-md-4 form-group">
                        <label class="form-control-label">Etat de la mission</label>
                        <input type="text" placeholder="Autochargement de l'etat" value="{{ $carburant->etat_mission }}"
                            class="form-control form-control-sm etat_mission" disabled id="etat_mission">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="input-27">Carburant</label>
                        <select name="type_carburant" id="type_carburant" class="form-control" tabindex="-1"
                            class="@error('type_carburant') is-invalid @enderror">
                            <option value="0" disabled="true" selected="true">{{ $carburant->type_carburant }}</option>
                            <option>Essance</option>
                            <option>Gasoil</option>
                            @error('type_carburant')
                                <button class="btn-danger">{{ $message }}</button>
                            @enderror
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="input-27">Fournisseur</label>
                        <select name="fournisseur_id" id="" class="form-control">
                            @foreach ($fournisseurs as $fournisseur)
                            <option value="{{ $fournisseur->id }}" {!! $carburant->fournisseur_id == $fournisseur->id ? 'selected="selected"' : '' !!}>
                                {{ $fournisseur->nom_fournisseur }}</option>
                            @endforeach
                            @error('fournisseur_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                        <label for="input-28">PU en FraBu</label>
                        <input type="number" name="prix_unitaire" id="unit" required="required"
                            class="form-control prix_unitaire" class="@error('prix_unitaire') is-invalid @enderror"
                            placeholder="" value="{{ $carburant->prix_unitaire }}">
                        @error('prix_unitaire')
                            <button class="btn-danger">{{ $message }}</button>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="input-28">Qte en L</label>
                        <input type="number" name="quantite" id="quantit" required="required"
                            class="form-control quantite" class="@error('quantite') is-invalid @enderror"
                            placeholder="" value="{{ $carburant->quantite }}">
                        @error('quantite')
                            <button class="btn-danger">{{ $message }}</button>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="input-27">PT en FraBu</label>
                        <input type="number" name="prix_total" id="prix_total" required="required"
                            class="form-control prix_total" class="@error('prix_total') is-invalid @enderror"
                            placeholder="" value="{{ $carburant->prix_total }}" disabled>
                        @error('prix_total')
                            <button class="btn-danger">{{ $message }}</button>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="input-28">Distance en Km</label>
                        <input type="number" name="distance" id="distance" required="required" class="form-control "
                            class="@error('distance') is-invalid @enderror" placeholder="" value="{{ $carburant->distance }}">
                        @error('distance')
                            <button class="btn-danger">{{ $message }}</button>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="input-27">Km/L</label>
                        <input type="number" name="distance_littre" id="distance_littre" required="required"
                            class="form-control " class="@error('distance_littre') is-invalid @enderror"
                            placeholder="" value="{{ $carburant->distance_littre }}" disabled>
                        @error('distance_littre')
                            <button class="btn-danger">{{ $message }}</button>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button href="{{ url('carburants') }} type="submit" class="btn btn-primary shadow-primary m-1"><i class="fa fa-backward"></i>
                                ABANDONNER LA MODIFICATION</button>
                    <button type="submit" onclick="return confirm('Voulez vous modifier la consommationdu carburent ?')"
                             class="btn btn-success shadow-success m-1"><i
                                    class="fa fa-check-square-o"></i>
                                CONFIRMER LA MODIFICATION</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection