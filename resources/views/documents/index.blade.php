@extends('layouts.layout')
@section('content')
@section('title', 'Document | ' . config('app.name'))

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4 bg-primary">
        <h1 class="h3 mb-2 text-gray-800" style="float: left">Ajouter un document</h1>
        <!--<button type="submit" class="btn btn-dark btn-sm" style="float: right">Cr&eacute;er</button>-->
    </div>
    <div class="card shadow mb-4 border-bottom-primary">
        <div class="card-body">
            <img id="output" height="300" width="300" />
            <form action="{{ route('file.upload.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col col-md-4 form-group">
                        <label for="vehicule_id" class="form-control-label">Vehicule</label>
                        <select class="form-control select2  plaque" id="missio_id" name="vehicule_id">
                            <option selected="selected">Choisir la plaque</option>
                            @foreach ($vehicules as $vehicule)
                                <option data-price="{{ $vehicule->etat }}" value="{{ $vehicule->id }}">
                                    {{ $vehicule->plaque }}</option>
                            @endforeach
                            @error('vehicule_id')
                                <div class="alert alert-danger">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </select>
                    </div>
                    <div class="col col-md-4 form-group">
                        <label class="form-control-label">Etat du vehicule</label>
                        <input id="etat_mission" type="text" placeholder="Autochargement de l'etat"
                            class="form-control form-control-sm etat" disabled>
                    </div>
                    <div class="col col-md-4 form-group">
                        <label for="prix" class="form-control-label">Prix du document</label>
                        <input type="number" id="prix" name="prix"
                            class="@error('prix') is-invalid @enderror form-control form-control-sm">
                        @error('prix')
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col col-md-4 form-group">
                        <label for="debut_validite" class="form-control-label">Date de d&eacute;but de
                            validite</label>
                        <input type="date" id="debut_validite" name="debut_validite"
                            class="@error('debut_validite') is-invalid @enderror form-control form-control-sm">
                        @error('debut_validite')
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col col-md-4 form-group">
                        <label for="fin_validite" class="form-control-label">Date de fin de validite</label>
                        <input type="date" id="fin_validite" name="fin_validite"
                            class="@error('fin_validite') is-invalid @enderror form-control form-control-sm">
                        @error('fin_validite')
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col col-md-4 form-group">
                        <label for="fournisseur_id" class="form-control-label">Fournisseur</label>
                        <select class="form-control select2" name="fournisseur_id">
                            <option selected="selected">Choisir un fournisseur</option>
                            @foreach ($fournisseurs as $fournisseur)
                                <option value="{{ $fournisseur->id }}">
                                    {{ $fournisseur->nom_fournisseur }}</option>
                            @endforeach
                            @error('fournisseur_id')
                                <div class="alert alert-danger">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fileName" class="form-control-label">Nom du document</label>
                    <input type="text" id="fileName" name="fileName" placeholder="Entrer le nom du document"
                        class="@error('fileName') is-invalid @enderror form-control form-control-sm">
                    @error('fileName')
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="file" name="file" class="form-control" id="image" onchange="loadFile(event)">
                        @error('file')
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Cr&eacute;er</button>
            </form>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-head">
                        <h4 style="float: left">liste des documents</h4>
                        <a href="{{ url('show') }}" style="float: right" class="btn btn-primary">
                            <i class="fa fa-plus"></i>Voir en detail les documents</a>
                    </div>
                    @error('fileName')
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
                                    <th>Marque</th>
                                    <th>Modele</th>
                                    <th>Plaque</th>
                                    <th>Nom document</th>
                                    <th>Document</th>
                                    <th>Fournisseur</th>
                                    <th>Fin de validite</th>
                                    <th>Utitisateur</th>
                                    <th>Prix</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($documents as $key => $document)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $document->nom_marque }}</td>
                                        <td>{{ $document->nom_modele }}</td>
                                        <td>{{ $document->plaque }}</td>
                                        <td>{{ $document->fileName }}</td>
                                        <td>{{ $document->file }}</td>
                                        <td>{{ $document->nom_fournisseur }}</td>
                                        <td>{{ $document->fin_validite }}</td>
                                        <td>{{ number_format($document->prix, 0) }} FraBu</td>
                                        <td>{{ $document->name }}
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

@endsection
