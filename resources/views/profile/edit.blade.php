<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/logo.png')}}">
    <title >Système de Planification</title>

    <!-- This page css -->
    <link href="{{asset('dist/css/style.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/all.min.css')}}">

    <link href="{{asset('assets/libs/morris.js/morris.css')}}" rel="stylesheet">
</head>
<body>

    <!-- Content Wrapper -->
    <div class="page-wrapper">

                <!-- Topbar -->
                {{-- <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow" style="background-color: #0077b3;">
                    <a class="navbar-brand ms-5 text-light" href="{{ route('directeur.dashboard') }}"><i class="fa-solid fa-person-walking-arrow-loop-left"></i> Page d'accueil</a>

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-light d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>
                
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-light">
                                    <div>{{ Auth::user()->name }} {{ Auth::user()->lname }}</div>
                                </span>
                                <i class="fa-solid fa-user fa-xl" style="color: #ffffff;"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{route('profile.edit')}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profil
                                </a>
                                <div class="dropdown-divider"></div>
                                <button class="dropdown-item btn" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                    <i data-feather="power" class="svg-icon me-2 ms-1"></i>
                                    Se déconnecter
                                </button>
                            </div>
                        </li>
                
                    </ul>
                
                </nav> --}}

                <header class="topbar" data-navbarbg="skin6">
                    <nav class="navbar top-navbar navbar-expand-lg" style="background-color: #0077b3; max-height:5px;">
                        <div class="navbar-header" data-logobg="skin6" style="background-color: transparent">
                            <!-- This is for the sidebar toggle which is visible on mobile only -->
                            <a class="nav-toggler waves-effect waves-light d-block d-lg-none" href="javascript:void(0)"><i
                                class="ti-menu ti-close"></i>
                            </a>

                            <div class="navbar-brand justify-content-center">
                                <a class="navbar-brand ms-5 text-light" href="{{ route('directeur.dashboard') }}"><i class="fa-solid fa-person-walking-arrow-loop-left"></i> <span class="ms-1">Page d'accueil</span></a>
                            </div>
                            <!-- ============================================================== -->
                            <!-- End Logo -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- Toggle which is visible on mobile only -->
                            <!-- ============================================================== -->
                            <a class="topbartoggler d-block d-lg-none waves-effect waves-light" href="javascript:void(0)"
                                data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                                    class="ti-more"></i></a>
                        </div>
                        <!-- ============================================================== -->
                        <!-- End Logo -->
                        <!-- ============================================================== -->
                        <div class="navbar-collapse collapse" id="navbarSupportedContent" style="border-bottom: transparent;">
                            <!-- ============================================================== -->
                            <!-- toggle and nav items -->
                            <!-- ============================================================== -->
                            <ul class="navbar-nav float-left me-auto ms-3 ps-1">
                                
                                <li class="nav-item dropdown ms-3 mt-4">
        
        
                                </li>
        
                                <!-- ============================================================== -->
                                <!-- create new -->
                                <!-- ============================================================== -->
        
                            </ul>
        
                            <!-- ============================================================== -->
                            <!-- Right side toggle and nav items -->
                            <!-- ============================================================== -->
                            <ul class="navbar-nav float-end">
                                <!-- User profile and search -->
                                <!-- ============================================================== -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <img src="{{asset('assets/images/users/user__.png')}}" alt="user" class="rounded-circle border border-1"
                                            width="40">
                                            <span class="ms-2 d-none d-lg-inline-block"><span></span> <span
                                            class="text-light">Directeur {{ Auth::user()->name }}</span> <i data-feather="chevron-down"
                                            class="svg-icon"></i></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-right user-dd animated flipInY">
                                        <a class="dropdown-item" href="{{route('profile.edit')}}"><i data-feather="user"
                                                class="svg-icon me-2 ms-1"></i>
                                            Profile
                                        </a>
        
        
                                        <div class="dropdown-divider"></div>
                                        {{-- <a class="dropdown-item" href="javascript:void(0)"><i data-feather="power"
                                                class="svg-icon me-2 ms-1"></i>
                                            Logout
                                        </a> --}}
        
                                        <button class="dropdown-item btn" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                            <i data-feather="power" class="svg-icon me-2 ms-1"></i>
                                            Se déconnecter
                                        </button>
        
                                    </div>
                                </li>
                                <!-- ============================================================== -->
                                <!-- User profile and search -->
                                <!-- ============================================================== -->
                            </ul>
                        </div>
                    </nav>
                </header>

                <div class="container">
                    <div class="row">

                        <div class="col-12">

                            <div class="card">
                                <div class="card-body">

                                    <div class="card-header mb-1  text-dark">
                                        <h5 class="font-weight-medium">Proposer des actions aux Directions Régionales</h5>
                                    </div>

                                    <div class="row">

                                        <div class="col-3 mt-5">
                                            <img src="{{asset('assets/add-user.png')}}" width="250" height="260" class="d-inline-block rounded-circle" alt="Utilisateur">
                                        </div>
                                        <div class="col-9">
                                            <div class="row">
                                                <div class="card col-6 p-1">
                                                    <div class="card-body">
                                                        @include('profile.partials.update-profile-information-form')
                                                    </div>
                                                </div>  

                                                <div class="card col-6 p-1">
                                                    <div class="card-body">
                                                        @include('profile.partials.update-password-form')
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
    </div>

    <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h4 class="modal-title text-light" id="myLargeModalLabel"></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">Cliquez sur « Se déconnecter » ci-dessous si vous êtes prêt à mettre fin à votre session en cours.</div>
                    <div class="modal-footer">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            {{-- <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button> --}}
                            <button class="btn btn-primary">
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Se déconnecter') }}
                                </x-dropdown-link>
                            </button>
                        
                        </form>
                    </div>

                    

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    <script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>

    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>

    <script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="{{asset('dist/js/app-style-switcher.js')}}"></script>

    <script src="{{asset('dist/js/feather.min.js')}}"></script>
    <script src="{{asset('assets/all.min.js')}}"></script>

    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>

    <script src="{{asset('assets/extra-libs/sparkline/sparkline.js')}}"></script>
    <!--Wave Effects -->
    <!-- themejs -->
    <!--Menu sidebar -->

    <script src="{{asset('dist/js/sidebarmenu.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('dist/js/custom.min.js')}}"></script>
    <!-- This Page JS -->
    <!--Morris JavaScript -->
    <script src="{{asset('assets/libs/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('assets/libs/morris.js/morris.min.js')}}"></script>

</body>
</html>
