@extends('layouts.layout')
@section('content')
@section('title', 'Marque | ' . config('app.name'))

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-head">
                            <h4 style="float: left">Ajouter la marque</h4>
                            <a href="" style="float: right" class="btn btn-primary" data-toggle="modal"
                                data-target="#addmarque">
                                <i class="fa fa-plus"></i>Ajouter la marque</a>
                        </div>
                        @error('nom_marque')
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
                                        <th>Utitisateur</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($marques as $key => $marque)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $marque->nom_marque }}</td>
                                            <td>{{ $marque->name }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="" class="btn btn-sm btn-info" data-toggle="modal"
                                                        data-target="#editmarque{{ $marque->id }}"><i
                                                            class="fa fa-edit"></i>Edit</a>
                                                    {{-- <a href="" class="btn btn-sm btn-danger" data-toggle="modal"
                                                        data-target="#deletemarque{{ $marque->id }}"><i
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
    <div class="modal right fade" id="addmarque" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="staticBackdropLabel">Ajouter la marque</h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('marques.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Marque</label>
                            <input type="text" name="nom_marque" id="" class="form-control" placeholder="marque"
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

    <div class="modal right fade" id="editmarque{{ $marque->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="staticBackdropLabel">Modifier la marque</h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('marques.update', $marque->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="">Marque</label>
                            <input type="text" name="nom_marque" id="" value="{{ $marque->nom_marque }}"
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

    <div class="modal right fade" id="deletemarque{{ $marque->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="staticBackdropLabel">Supprimer la marque</h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('marques.destroy', $marque->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <p>Tu es sur de vouloir supprimer {{ $marque->nom_marque }} ?</p>
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
