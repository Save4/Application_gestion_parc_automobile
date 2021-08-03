@extends('layouts.layout')
@section('content')
@section('title', 'Chauffeur | ' . config('app.name'))

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-head">
                            <h4 style="float: left">Ajouter le chauffeur</h4>
                            <a href="" style="float: right" class="btn btn-primary" data-toggle="modal"
                                data-target="#addchauffeur">
                                <i class="fa fa-plus"></i>Ajouter le chauffeur</a>
                        </div>
                        @error('nume_permis_conduire')
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
                                        <th>Nom</th>
                                        <th>Prenom</th>
                                        <th>Contacts</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($chauffeurs as $key => $chauffeur)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $chauffeur->nom_chauf }}</td>
                                            <td>{{ $chauffeur->prenom_chauf }}</td>
                                            <td>{{ $chauffeur->nume_permis_conduire }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="" class="btn btn-sm btn-info" data-toggle="modal"
                                                        data-target="#editchauffeur{{ $chauffeur->id }}"><i
                                                            class="fa fa-edit"></i>Edit</a>
                                                    <a href="" class="btn btn-sm btn-danger" data-toggle="modal"
                                                        data-target="#deletechauffeur{{ $chauffeur->id }}"><i
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
    <!-- modal of adding product -->
    <div class="modal right fade" id="addchauffeur" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="staticBackdropLabel">Ajouter le chauffeur</h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('chauffeurs.store') }}" method="POST">
                        @csrf
                        <div class="form-row addMarque">
                            <div class="form-group col-md-12">
                                <label for="input-28">Nom</label>
                                <input type="text" name="nom_chauf" id="first-name" required="required"
                                    class="form-control " class="@error('nom_chauf') is-invalid @enderror"
                                    placeholder="Entre le nom du chauffeur" value="">
                                @error('nom_chauf')
                                    <button class="btn-danger">{{ $message }}</button>
                                @enderror
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="input-28">Prenom</label>
                                <input type="text" name="prenom_chauf" id="first-name" required="required"
                                    class="form-control " class="@error('prenom_chauf') is-invalid @enderror"
                                    placeholder="Entre le prenom du chauffeur" value="">
                                @error('prenom_chauf')
                                    <button class="btn-danger">{{ $message }}</button>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="input-28">Contacts</label>
                                <input type="text" name="nume_permis_conduire" id="first-name" required="required"
                                    class="form-control " class="@error('nume_permis_conduire') is-invalid @enderror"
                                    placeholder="Entre la plaque" value="">
                                @error('nume_permis_conduire')
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

    <div class="modal right fade" id="editchauffeur{{ $chauffeur->id }}" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="staticBackdropLabel">Modifier l'identification du chauffeur</h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('chauffeurs.update', $chauffeur->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="input-28">Nom</label>
                                <input type="text" name="nom_chauf" id="first-name" required="required"
                                    class="form-control " class="@error('nom_chauf') is-invalid @enderror" placeholder=""
                                    value="{{ $chauffeur->nom_chauf }}">
                                @error('nom_chauf')
                                    <button class="btn-danger">{{ $message }}</button>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label for="input-28">Premon</label>
                                <input type="text" name="prenom_chauf" id="first-name" required="required"
                                    class="form-control " class="@error('prenom_chauf') is-invalid @enderror" placeholder=""
                                    value="{{ $chauffeur->prenom_chauf }}">
                                @error('prenom_chauf')
                                    <button class="btn-danger">{{ $message }}</button>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="input-28">Contacts</label>
                                <input type="text" name="nume_permis_conduire" id="first-name" required="required"
                                    class="form-control " class="@error('nume_permis_conduire') is-invalid @enderror"
                                    placeholder="" value="{{ $chauffeur->nume_permis_conduire }}">
                                @error('nume_permis_conduire')
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

    <div class="modal right fade" id="deletechauffeur{{ $chauffeur->id }}" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" id="staticBackdropLabel">Supprimer l'identification du chauffeur</h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('chauffeurs.destroy', $chauffeur->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <p>Tu es sur de vouloir supprimer {{ $chauffeur->nom_chauf }} {{ $chauffeur->prenom_chauf }} ?
                        </p>
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
