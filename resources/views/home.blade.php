{{-- @extends('layouts.layout')

@section('content')
@section('title', 'Home | ' . config('app.name'))
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">


                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

@extends('layouts.app')

@section('content')
@section('title', 'Home | ' . config('app.name'))
<div class="container">

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
            <h1> Gestion stock</h1>
        </div>
    @endif

    <div class="alert btn-danger">
        <p class="lead text-center"> <b>Bienvenue a notre application de gestion du parc automobile </b> </p>
    </div>

    <div class="row">

        @can('mission-list')
            <div class="col-md-4">
                <a href="{{ route('missions.index') }}" class="thumbnail">
                    <img src="images/mission.jpg" alt="mission" height="200" width="300">
                </a>
                <h4 class="text-center">Les missions</h4>
            </div>
        @endcan
        @can('document-list')
            <div class="col-md-4">
                <a href="{{ route('documents.index') }}" class="thumbnail">
                    <img src="images/document.jpg" class="img-responsive" alt="..." height="200" width="300">
                </a>
                <h4 class="text-center">Les documents</h4>
            </div>
        @endcan
        @can('carburant-list')
            <div class="col-md-4">
                <a href="{{ route('carburants.index') }}" class="thumbnail">
                    <img src="images/carburent.jpg" alt="..." height="200" width="300">
                </a>
                <h4 class="text-center">les consommations du carburent</h4>
            </div>
        @endcan
        @can('piece-list')
            <div class="col-md-4">
                <a href="{{ route('pieces.index') }}" class="thumbnail">
                    <img src="images/pieces.jpg" alt="piece de rechange" height="200" width="300">
                </a>
                <h4 class="text-center">Les pieces de rechange</h4>
            </div>
        @endcan
        @can('reparation-list')
            <div class="col-md-4">
                <a href="{{ route('reparations.index') }}" class="thumbnail">
                    <img src="images/reparation.jpg" class="img-responsive" alt="..." height="200" width="300">
                </a>
                <h4 class="text-center">Les reparations</h4>
            </div>
        @endcan




    </div>
</div>
@endsection
