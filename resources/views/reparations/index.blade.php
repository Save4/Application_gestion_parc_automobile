@extends('layouts.layout')
@section('content')
@section('title', 'Reparation | ' . config('app.name'))



<div class="container-fluid">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-head">
                        <h4 style="float: left">Ajouter des reparation</h4>
                        <a href="" style="float: right" class="">
                        </a>
                    </div>
                    <form action="{{ route('reparations.store') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <table class="table table-bordered table-left table-responsive">

                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Plaque</th>
                                        <th>Piece</th>
                                        <th>Nombre</th>
                                        <th>PriX du piece</th>
                                        <th>prix total des pieces</th>
                                        <th>Type de panne</th>
                                        <th>Main d'oeuvre</th>
                                        <th>Total</th>
                                        <th> <a href="#" class="btn btn-sm btn-primary rounded-circle add_more"><i
                                                    class="fa fa-plus-circle"></i></a> </th>
                                    </tr>
                                </thead>
                                <tbody class="addreparation">
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <select name="vehicule_id[]" id="vehicule_id"
                                                class="form-control vehicule_id">
                                                <option value="">Choisir plaque</option>
                                                @foreach ($vehicules as $vehicule)
                                                    <option value="{{ $vehicule->id }}">{{ $vehicule->plaque }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select name="piece_id[]" id="piece_id" class="form-control piece_id">
                                                <option value="">Choisir piece</option>
                                                @foreach ($pieces as $piece)
                                                    <option data-price="{{ $piece->prix_piece }}"
                                                        value="{{ $piece->id }}">{{ $piece->nom_piece }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="nombre[]" id="nombre"
                                                class="form-control nombre">
                                        </td>
                                        <td>
                                            <input type="number" name="prix_piece[]" id="prix_piece"
                                                class="form-control prix_piece">
                                        </td>
                                        <td>
                                            <input type="number" name="prix_toto_piece[]" id="prix_toto_piece"
                                                class="form-control prix_toto_piece">
                                        </td>
                                        <td>
                                            <input type="text" name="type_panne[]" id="type_panne"
                                                class="form-control type_panne">
                                        </td>
                                        <td>
                                            <input type="number" name="main_oeuvre[]" id="main_oeuvre"
                                                class="form-control main_oeuvre">
                                        </td>
                                        <td>
                                            <input type="number" name="toto_conso[]" id="toto_conso"
                                                class="form-control toto_conso">
                                        </td>
                                        <td><a href="#" class="btn btn-sm btn-danger delete rounded-circle"><i
                                                    class="fa fa-times-circle"></i></a></td>

                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th rowspan="1" colspan="1">Total</th>
                                        <th rowspan="1" colspan="7"></th>

                                        <th rowspan="1" colspan="1" class="total" jAutoCalc="SUM({toto_conso})">0.00
                                        </th>
                                        <th rowspan="1" colspan="1"><button type="" name="" id=""
                                                class="btn btn-sm btn-primary rounded-circle btn-block"><i
                                                    class="fa fa-plus"></i>Add</button></th>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
                </div>
            </div>
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
                        <h4 style="float: left">liste des reparations</h4>
                    </div>
                    @error('type_panne')
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
                                    <th>Piece</th>
                                    <th>Nombre de piece</th>
                                    <th>PriX unitaire</th>
                                    <th>prix total</th>
                                    <th>Type de panne</th>
                                    <th>Main d'oeuvre</th>
                                    <th>Total </th>
                                    <th>Date d'enregistrement</th>
                                    <th>Utitisateur</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reparations as $key => $reparation)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $reparation->nom_marque }}</td>
                                        <td>{{ $reparation->nom_modele }}</td>
                                        <td>{{ $reparation->plaque }}</td>
                                        <td>{{ $reparation->nom_piece }}</td>
                                        <td>{{ $reparation->nombre }}pieces</td>
                                        <td>{{ number_format($reparation->prix_piece, 0) }} FraBu </td>
                                        <td>{{ number_format($reparation->prix_toto_piece, 0) }} FraBu </td>
                                        <td>{{ $reparation->type_panne }}</td>
                                        <td>{{ number_format($reparation->main_oeuvre, 0) }} FraBu </td>
                                        <td class="conso_t">{{ number_format($reparation->toto_conso, 0) }} FraBu
                                        </td>
                                        <td>{{ $reparation->created_at }}</td>
                                        {{-- <td>{{ $reparation->updated_at }}</td> --}}
                                        <td>{{ $reparation->name }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="reparations/{{$reparation->id }}/edit" class="btn btn-sm btn-info"><i
                                                        class="fa fa-edit"></i>Edit</a>
                                                <a href="" class="btn btn-sm btn-danger" data-toggle="modal"
                                                    data-target="#deletereparation{{ $reparation->id }}"><i
                                                        class="fa fa-trash"></i>Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{-- <tfoot>
                                    <tr>
                                        <th rowspan="1" colspan="10">Total</th>
                                        <th rowspan="1" colspan="4" class="total_t">0.00
                                        </th>
                                    </tr>
                                </tfoot> --}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
{{-- @section('script')
<script>
    $(document).ready(function(){
        alert(1);
    })
</script> --}}
