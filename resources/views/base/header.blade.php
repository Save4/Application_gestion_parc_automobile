<nav class="main-header navbar navbar-expand-md navbar-light navbar-lightblue">
    <div class="container">
        <a href="{{ url('/home') }}" class="navbar-brand">
            <img src="{{ asset('dist/img/logo.png') }}" alt="Automobile" class="brand-image img-circle elevation-3"
                style="opacity: .8">
            <span class="brand-text font-weight-light">Parc automobile</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        class="nav-link dropdown-toggle">Missions</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                   @can('mission-list')
                        <li><a href="{{ url('missions') }}" class="dropdown-item">Missions </a></li>
                        @endcan
                        <li class="dropdown-divider"></li>


                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        class="nav-link dropdown-toggle">Consommations</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                      @can('document-list')
                        <li><a href="{{ url('documents') }}" class="dropdown-item">Documents </a></li>
                        @endcan
                        @can('carburant-list')
                        <li><a href="{{ url('carburants') }}" class="dropdown-item">Carburents </a></li>
                        @endcan
                        @can('piece-list')
                        <li><a href="{{ url('pieces') }}" class="dropdown-item">Pieces </a></li>
                        @endcan
                        @can('reparation-list')
                        <li><a href="{{ url('reparations') }}" class="dropdown-item">Reparations </a></li>
                        @endcan
                        <li class="dropdown-divider"></li>


                    </ul>
                </li>
            </ul>
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <!--   <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>-->
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            @can('user-list')
                                <div>
                                    <a class="dropdown-item" href="{{ route('users.index') }}">Liste des utilisateurs</a>
                                    <a class="dropdown-item" href="{{ route('roles.index') }}">Liste des roles</a>
                                </div>
                            @endcan
                        </div>
                    </li>
                @endguest
            </ul>

        </div>

        <!-- Right navbar links -->

    </div>
</nav>
