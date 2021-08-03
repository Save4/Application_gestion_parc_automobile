@extends('layouts.layout')
@section('content')
@section('title', 'Document | ' . config('app.name'))
    {{-- <div class="col-md-12">
 @foreach ($documents as $document)
    <div class="col-md-4">
        <div class="card rounded shadow bg-white border-bottom-primary">
            <div class="mw-100">
                <a href="">
                    <img src="{{ asset('uploads/'.$document->file) }}" alt="{{ $document->fileName }}" class="w-100 rounded-top">
                </a>
            </div>
            <p class="bg-dark text-white text-center rounded-bottom pb-2">
                <strong>{{ $document->fin_validite }}</strong>
            </p>
            <p class="h5 pl-2 pt-2">
                <a href="" class="text-dark text-decoration-none">
                    {{ $document->fileName }}
                </a>
            </p>
            <p class="pl-2 pt-2">
                <span class="badge badge-info">Debut de validite</span> {{ $document->debut_validite }} <br>
                <span class="badge badge-info">Fin de validite</span> {{ $document->fin_validite }}
            </p>
            <div class="card-footer">
                <div class="btn-group">
                    <a href="" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit mr-1"></i>Modifier
                    </a>

                    <form action="" method="post" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer cet document ?')">
                            <i class="fas fa-trash-alt mr-1"></i>Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- /# column -->
    @endforeach
</div> --}}


    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-head">
                            <h4 style="float: left">liste des documents</h4>
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
                                        <th>Debut de validite</th>
                                        <th>Fin de validite</th>
                                        <th>Prix</th>
                                        <th>Date de creation</th>
                                        <th>Date de modification</th>
                                        <th>Utitisateur</th>
                                        <th>Voir</th>
                                        <th>Telecharger</th>
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
                                            <td>{{ $document->debut_validite }}</td>
                                            <td>{{ $document->fin_validite }}</td>
                                            <td>{{ number_format($document->prix, 0) }} FraBu</td>
                                            <td>{{ $document->created_at }}</td>
                                            <td>{{ $document->updated_at }}</td>
                                            <td>{{ $document->name }} {{ $document->email }}</td>
                                            <td><a href="{{ url('/voirdocument',$document->id) }}" class="btn btn-sm btn-secondary">Voir</a></td>
                                            <td><a href="{{ url('/telecharger',$document->file) }}" class="btn btn-sm btn-warning">Telecharger</a></td>
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
