@extends('layouts.layout')
@section('content')
@section('title', 'Modele | ' . config('app.name'))

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-head">
                            <h4 style="float: left">Ajouter le modele</h4>
                            <a href="" style="float: right" class="btn btn-primary" data-toggle="modal"
                                data-target="#addmodele">
                                <i class="fa fa-plus"></i>Ajouter le modele</a>
                        </div>
                        @error('nom_modele')
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
                                        <th>Marque</th>
                                        <th>Modele</th>
                                        <th>Utitisateur</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($modeles as $key => $modele)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $modele->nom_marque }}</td>
                                            <td>{{ $modele->nom_modele }}</td>
                                            <td>{{ $modele->name }}
                                            <td>
                                                <div class="btn-group">
                                                    <a href="" class="btn btn-sm btn-info" data-toggle="modal"
                                                        data-target="#editmodele{{ $modele->id }}"><i
                                                            class="fa fa-edit"></i>Edit</a>
                                                    <a href="" class="btn btn-sm btn-danger" data-toggle="modal"
                                                        data-target="#deletemodele{{ $modele->id }}"><i
                                                            class="fa fa-trash"></i>Delete</a>
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
    <div class="modal right fade" id="addmodele" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="staticBackdropLabel">Ajouter le modele</h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('modeles.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Marque</label>
                            <select class="form-control @error('nom_marque') is-danger @enderror" name="marque_id"
                                id="marque_id"">
                                <option>Selectionnner la marque</option>
                                @foreach ($marques as $marque)
                                <option value="{{ $marque->id }}">{{ $marque->nom_marque }}</option>
                                @endforeach
                                @error('marque_id')
                                    <div class="alert alert-danger">{{ $message }}
                                    </div>
                                @enderror
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Modele</label>
                            <input type="text" name="nom_modele" id="" class="form-control" placeholder="modele"
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

    <div class="modal right fade" id="editmodele{{ $modele->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="staticBackdropLabel">Modifier le modele</h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('modeles.update', $modele->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group">
                                    <label for="">Marque</label>
                                    <select class="form-control @error('nom_marque') is-danger @enderror" name="marque_id"
                                        id="marque_id">
                                        @foreach ($marques as $marque)
                                        <option value="{{ $marque->id }}" {!! $modele->marque_id == $marque->id ? 'selected="selected"' : '' !!}>
                                            {{ $marque->nom_marque }}</option>
                                        @endforeach
                                        @error('marque_id')
                                            <div class="alert alert-danger">{{ $message }}
                                            </div>
                                        @enderror
                                        @error('marque_id')
                                            <code> {{ $message }}</code>
                                        @enderror
                                    </select>
                                </div>
                        <div class="form-group">
                            <label for="">Modele</label>
                            <input type="text" name="nom_modele" id="" value="{{ $modele->nom_modele }}"
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

    <div class="modal right fade" id="deletemodele{{ $modele->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="staticBackdropLabel">Supprimer le modele</h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('modeles.destroy', $modele->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <p>Tu es sur de vouloir supprimer {{ $modele->nom_modele }} ?</p>
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
