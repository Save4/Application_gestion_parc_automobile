@extends('layouts.layout')
@section('content')
@section('title', 'Piece | ' . config('app.name'))

<div class="container-fluid">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-head">
                        <h4 style="float: left">Ajouter une piece</h4>
                        <a href="" style="float: right" class="btn btn-primary" data-toggle="modal"
                            data-target="#addpiece">
                            <i class="fa fa-plus"></i>Ajouter une piece</a>
                    </div>
                    @error('nom_piece')
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
                        <table id="default-datatable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom d'une piece</th>
                                    <th>Prix</th>
                                    <th>Fournisseur</th>
                                    <th>Utitisateur</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pieces as $key => $piece)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $piece->nom_piece }}</td>
                                        <td>{{ number_format($piece->prix_piece, 0) }}FraBu</td>
                                        <td>{{ $piece->nom_fournisseur }}</td>
                                        <td>{{ $piece->name }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="" class="btn btn-sm btn-info" data-toggle="modal"
                                                    data-target="#editpiece{{ $piece->id }}"><i
                                                        class="fa fa-edit"></i>Edit</a>
                                                {{-- <a href="" class="btn btn-sm btn-danger" data-toggle="modal"
                                                        data-target="#deletepiece{{ $piece->id }}"><i
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
</div>
<!-- modal of adding product -->
<div class="modal right fade" id="addpiece" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="staticBackdropLabel">Ajouter une piece</h4>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pieces.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Fournisseur</label>
                        <select class="form-control @error('nom_fournisseur') is-danger @enderror" name="fournisseur_id"
                            id="marque_id"">
                                <option>Selectionnner la fournisseur</option>
                                     @foreach ($fournisseurs as $fournisseur)
                            <option value="{{ $fournisseur->id }}">{{ $fournisseur->nom_fournisseur }}</option>
                            @endforeach
                            @error('fournisseur_id')
                                <div class="alert alert-danger">{{ $message }}
                                </div>
                            @enderror
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Piece</label>
                        <input type="text" name="nom_piece" id="" class="form-control" placeholder="piece"
                            aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="">Prix</label>
                        <input type="number" name="prix_piece" id="" class="form-control" placeholder="prix_piece"
                            aria-describedby="helpId">
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

<div class="modal right fade" id="editpiece{{ $piece->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="staticBackdropLabel">Modifier une piece</h4>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pieces.update', $piece->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="">Marque</label>
                        <select class="form-control @error('nom_fournisseur') is-danger @enderror" name="fournisseur_id"
                            id="fournisseur_id">
                            @foreach ($fournisseurs as $fournisseur)
                                <option value="{{ $fournisseur->id }}" {!! $piece->fournisseur_id == $fournisseur->id ? 'selected="selected"' : '' !!}>
                                    {{ $fournisseur->nom_fournisseur }}</option>
                            @endforeach
                            @error('fournisseur_id')
                                <div class="alert alert-danger">{{ $message }}
                                </div>
                            @enderror
                            @error('fournisseur_id')
                                <code> {{ $message }}</code>
                            @enderror
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Piece</label>
                        <input type="text" name="nom_piece" id="" value="{{ $piece->nom_piece }}"
                            class="form-control" placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="">Prix</label>
                        <input type="text" name="prix_piece" id="" value="{{ $piece->prix_piece }}"
                            class="form-control" placeholder="" aria-describedby="helpId">
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

<div class="modal right fade" id="deletepiece{{ $piece->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="staticBackdropLabel">Supprimer une piece</h4>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pieces.destroy', $piece->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <p>Tu es sur de vouloir supprimer {{ $piece->nom_piece }} ?</p>
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
