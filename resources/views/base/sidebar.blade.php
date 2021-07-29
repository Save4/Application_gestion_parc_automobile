<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="Automobile" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Parc automobile</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-car"></i>
                        <p>
                            Vehicules
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('marques') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Marque</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('modeles') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Modele</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('categories') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Categorie</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('vehicules') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Vehicules</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-university"></i>
                        <p>
                            Departements
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('departements') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Departements</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Missions
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('chauffeurs') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Chauffeurs</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('missions') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Missions</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Consommations
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!--<li class="nav-item">
                            <a href="{{ url('Type_document') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Type documents</p>
                            </a>
                        </li>-->
                        <li class="nav-item">
                            <a href="{{ url('documents') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Documents</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('carburents') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Carburent</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('piecess') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pieces</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('reparations') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Reparations</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
