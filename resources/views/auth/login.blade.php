@extends('layouts.layout_login')

@section('content')

    <!-- begin #page-loader -->
    <div id="page-loader" class="fade in"><span class="spinner"></span></div>
    <!-- end #page-loader -->

    <!-- begin #page-container -->
    <div id="page-container" class="fade">
        <!-- begin login -->
        <div class="login login-with-news-feed">
            <!-- begin news-feed -->
            <div class="news-feed">
                <div class="news-image">
                    <img src="images/back11.jpg" data-id="login-cover-image" alt="" />
                </div>
                <div class="news-caption">
                    <h4 class="caption-title"><i class="ion-ios-cloud m-r-15 fa-2x pull-left"></i> Bienvenue a notre
                        application</h4>
                    <p>
                        C'est une Application Web De Gestion du parc automobile !
                    </p>
                </div>
            </div>
            <!-- end news-feed -->
            <!-- begin right-content -->
            <div class="right-content">
                <!-- begin login-header -->
                <div class="login-header">
                    <div class="brand">
                        <span class="logo"><i class="ion-ios-cloud"></i></span>Parc automobile
                        <small>Application Web de Gestion du parc automobile !</small>
                    </div>
                    <div class="icon">
                        <i class="ion-ios-locked"></i>
                    </div>
                </div>
                <!-- end login-header -->
                <!-- begin login-content -->
                <div class="login-content">

                    <form method="POST" action="{{ route('login') }}" class="margin-bottom-0">
                        {{ csrf_field() }}
                        <div class="form-group m-b-15">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                                required autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group m-b-15">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="checkbox m-b-30">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Se souvenir
                                de Moi !
                            </label>
                        </div>
                        <div class="login-buttons">
                            <button type="submit" class="btn btn-primary btn-block btn-lg">Me Connectez</button>
                        </div>
                        <div class="m-t-20 m-b-40 p-b-40 text-inverse">
                            Mot de Passe Oublié Cliquez ! <a class="btn btn-link" href="{{ route('password.request') }}">
                                Ici </a>.
                        </div>
                    </form>
                    <style media="screen">
                        oo {
                            color: orange;
                        }

                    </style>
                    <hr />
                    <p class="text-center">
                        <strong> &copy; <oo>Yves et Carel </oo> Tous Droit Réservés !</strong>
                    </p>
                </div>
                <!-- end login-content -->
            </div>
            <!-- end right-container -->
        </div>
        <!-- end login -->


    </div>
    <!-- end page container -->

@endsection
