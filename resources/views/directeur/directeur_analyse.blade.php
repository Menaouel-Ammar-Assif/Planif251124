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


    {{------------------------------------------DataTables-----------------------------------------------------}}
    <link rel="stylesheet" href="{{asset('assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/extra-libs/datatables.net-bs4/css/responsive.dataTables.min.css')}}">
    {{------------------------------------------DataTables-----------------------------------------------------}}

    <link rel="stylesheet" href="{{asset('assets/all.min.css')}}">
    <!-- This page css -->
    <link href="{{asset('dist/css/style.min.css')}}" rel="stylesheet">

    <link href="{{asset('assets/libs/morris.js/morris.css')}}" rel="stylesheet">
</head>

<style>
    .ribbon
    {
        font-size: 28px;
        font-weight: bold;
        color: #fff;
    }
    .ribbon
    {
        --f: .5em;
        position: absolute;
        /* top: 0; */
        /* left: 0; */
        line-height: 1.8;
        padding-inline: 1lh;
        padding-bottom: var(--f);
        border-image: conic-gradient(#0008 0 0) 51%/var(--f);
        clip-path: polygon(
            100% calc(100% - var(--f)),100% 100%,calc(100% - var(--f)) calc(100% - var(--f)),var(--f) calc(100% - var(--f)), 0 100%,0 calc(100% - var(--f)),999px calc(100% - var(--f) - 999px),calc(100% - 999px) calc(100% - var(--f) - 999px));
        transform: translate(calc((cos(45deg) - 1)*100%), -100%) rotate(-45deg);
        transform-origin: 100% 100%;
        /* background-color: #F07818; */
        background: linear-gradient(to right, #f12711, #f5af19);
        z-index: +1;
    }
</style>
<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-lg" style="background-color: rgba(0, 76, 255, 0.56); max-height:5px;">
                <div class="navbar-header" data-logobg="skin6" style="background-color: transparent">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-lg-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-brand justify-content-center">
                        <!-- Logo icon -->
                        <a class="d-flex align-items-center " href="{{ route('directeur.dashboard') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        </a>
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

                            <div class="card py-3 px-2 text-light rounded-pill" style="width: max-content; background-color: transparent; font-size: 18px; font-weight: bolder">
                                {{$dir}}
                            </div>

                        </li>

                        <!-- ============================================================== -->
                        <!-- create new -->
                        <!-- ============================================================== -->

                    </ul>

                    <ul class="navbar-nav float-left me-3 ms-auto ps-1">
                        <!-- Notification -->
                        {{-- <li class="nav-item dropdown mt-2">
                            <a class="nav-link dropdown-toggle pl-md-3 position-relative" href="javascript:void(0)"
                                id="bell" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <span class="text-light"><i data-feather="bell" class="svg-icon"></i></span>
                                <span class="badge text-bg-primary notify-no rounded-circle">0</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-left mailbox animated bounceInDown">
                                <ul class="list-style-none">
                                    <li>
                                        <a class="nav-link pt-3 text-center text-dark" href="javascript:void(0);">
                                            <strong>Vérifiez toutes les notifications</strong>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li> --}}
                        <!-- End Notification -->
                    </ul>

                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-end">
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <!-- <li class="nav-item d-none d-md-block">
                            <a class="nav-link" href="javascript:void(0)">
                                <form>
                                    <div class="customize-input">
                                        <input class="form-control custom-shadow custom-radius border-0 bg-white"
                                            type="search" placeholder="Search" aria-label="Search">
                                        <i class="form-control-icon" data-feather="search"></i>
                                    </div>
                                </form>
                            </a>
                        </li> -->
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <img src="../assets/images/users/user__.png" alt="user" class="rounded-circle"
                                    width="40">
                                    <span class="ms-2 d-none d-lg-inline-block"><span></span> <span
                                    class="text-dark">Directeur {{$code}}</span> <i data-feather="chevron-down"
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


        <aside class="left-sidebar" data-sidebarbg="skin6" style="background-color:  rgba(0, 76, 255, 0.56);">
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link font-weight-medium" href="{{ route('consult.dashboard') }}"
                                aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                    class="hide-menu">Dashboard</span></a>
                        </li>

                        <li class="list-divider"></li>

                        @if (auth()->user()->id_dir && auth()->user()->id_dir >= 1 && auth()->user()->id_dir <= 14)
                        @else
                            <li class="sidebar-item">
                                <a class="sidebar-link font-weight-medium" href="{{ route('directeur.cop') }}" aria-expanded="false"><i data-feather="tag" class="feather-icon"></i>
                                <span class="hide-menu">Actions COP</span></a>
                            </li>
                        @endif

                        <li class="sidebar-item">
                            <a class="sidebar-link font-weight-medium" href="{{ route('directeur.proposition') }}" aria-expanded="false"><i class="fa-solid fa-wand-magic-sparkles me-2"></i>
                                @if (auth()->user()->id_dir && auth()->user()->id_dir >= 1 && auth()->user()->id_dir <= 14)
                                    <span class="hide-menu">Proposer Des Actions</span>
                                @else
                                    <span class="hide-menu">Actions Ajustées</span>
                                @endif
                            </a>
                        </li>


                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu font-weight-medium">C O P</span></li>

                        @if (auth()->user()->id_dir && auth()->user()->id_dir == '9')

                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('directeur.pageCalculate') }}"
                                    aria-expanded="false"><i class="fa-solid fa-calculator me-2 fa-lg"></i>
                                    <span>Les calculs</span>
                                </a>
                            </li>
                        @endif

                        <li class="sidebar-item">
                            <a class="sidebar-link font-weight-medium" href="{{ route('directeur.copAdd') }}" aria-expanded="false">
                                <i class="fa-solid fa-file-circle-plus fa-lg me-1"></i>
                                {{-- <i class="fa-solid fa-file-contract fa-lg pe-2"></i> --}}
                                <span>COP</span>
                            </a>
                        </li>



                                    <li class="list-divider"></li>
                                    <li class="sidebar-item">
                                        <a class="sidebar-link font-weight-medium" href="{{ route('directeur.analyse') }}" aria-expanded="false">
                                            <i class="fa-solid fa-magnifying-glass-chart fa-lg me-1"></i>
                                            <span>Analyse causale</span>
                                        </a>
                                    </li>


                    </ul>
                </nav>

            </div>
        </aside>

        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                    </div>
                </div>
            </div>

            <div class="container">

                <div class="row">
                    @if (session()->has('success'))
                        <div class="container-fluid">
                            <div class="alert alert-success">
                                <h4>{{session()->get('success')}}</h4>
                            </div>
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="container-fluid">
                            <div class="alert alert-danger">
                                <h4>{{session()->get('error')}}</h4>
                            </div>
                        </div>
                    @endif

                    @if (session()->has('info'))
                        <div class="container-fluid">
                            <div class="alert alert-primary">
                                <h4>{{session()->get('info')}}</h4>
                            </div>
                        </div>
                    @endif


                    @php
                        $months = [
                                    3 => 'trimestre',
                                    6 => 'semestre',
                                    9 => 'neuf mois',
                                    12 => 'annuel',
                                ];
                        $currentMonthNumber = (int) $month;
                    @endphp
                    {{-- <div class="align-self-center">
                        <div class=" float-end mb-4" style="width: revert;">
                            <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                                <option selected> <h1> {{$months[$currentMonthNumber]}} </h1> </option>
                            </select>
                        </div>
                    </div> --}}

                    <div class="col-lg-12">
                        <div class="ribbon">C O P</div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3" style="padding-top: 30px; margin-left:70px;">Ecart négatif, Objectif non atteint, Quels sont vos arguments? </h4>

                                <div class="col-lg-12 mt-4">
                                    <form action="{{ route('directeur.CauseStore') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-3 mt-4 mb-2" style="float: inline-end; padding: 8px;">
                                            <div class="input-group">

                                                <select class="form-select form-control formselect required custom-radius text-center" name="month" style="background-color: #49a4ff; color: #ffffff; text-transform: uppercase;" id="month">
                                                    @for ($i = 3; $i <= $currentMonthNumber; $i = $i+3)
                                                        @php
                                                            $paddedValue = str_pad($i, 2, '0', STR_PAD_LEFT);
                                                        @endphp
                                                        <option value="{{ $paddedValue }}" {{ $i == $currentMonthNumber ? 'selected' : '' }}>
                                                            {{ $months[$i] }}
                                                        </option>
                                                    @endfor
                                                </select>
                                                <label class="input-group-text font-weight-bold" for="month"><i class="fa-regular fa-calendar-days fa-xl"></i> </label>
                                            </div>
                                        </div>
                                        @foreach($indicateurs as $ind)
                                            @foreach ($latestCobValeur as $item)
                                                @if ($item->id_ind == $ind->id_ind)
                                                    @php
                                                        $periode = $item->periode->format('Y-m-d');
                                                    @endphp

                                                    <input type="hidden" name="periode[{{ $ind->id_ind }}]" value="{{ $periode }}">
                                                    <input type="hidden" name="indicateur_ids[]" value="{{ $ind->id_ind }}">
                                                    <input type="hidden" name="ecartType[{{ $ind->id_ind }}]" value="{{ $item->ecartType }}">

                                                    <div class="input-group mb-2">
                                                        <label class="input-group-text font-weight-bold" for="Indicateur-{{ $ind->id_ind }}" style="font-weight: bolder; color: #fff; background-color: #002379;">
                                                            <i class="fa-solid fa-arrow-trend-up me-1"></i> Indicateur :
                                                        </label>
                                                        <input type="text" class="form-control" value="{{ $ind->lib_ind }}" readonly>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-4 mb-2">
                                                            <div class="input-group">
                                                                <label class="input-group-text font-weight-bold" style="font-weight: bolder; color: #fff; background-color: #007900;">
                                                                    Resultat :
                                                                </label>
                                                                <input type="text" class="form-control" id="result-{{ $ind->id_ind }}" value="{{ $item->result }}" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="col-4 mb-2">
                                                            <div class="input-group">
                                                                <label class="input-group-text font-weight-bold" style="font-weight: bolder; color: #fff; background-color: #4d59ff9c;">
                                                                    <i class="fa-solid fa-crosshairs text-white me-1"></i> Cible :
                                                                </label>
                                                                <input type="text" class="form-control" id="cible-{{ $ind->id_ind }}" value="{{ $item->cible->cible }}" readonly>
                                                                <span class="input-group-text">{{ $item->cible->unite }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="col-4 mb-2">
                                                            <div class="input-group">
                                                                @if($item->ecartType == 'négatif')
                                                                    <label class="input-group-text font-weight-bold" style="font-weight: bolder; color: #fff; background-color: #f00f47;">
                                                                        <i class="fa-solid fa-down-long me-1" style="color: #fff;"></i> Ecart : {{$item->ecartType}}
                                                                    </label>
                                                                @else
                                                                    <label class="input-group-text font-weight-bold" style="font-weight: bolder; color: #fff; background-color: #0ec06d;">
                                                                        <i class="fa-solid fa-up-long me-1" style="color: #fff;"></i> Ecart : {{$item->ecartType}}
                                                                    </label>
                                                                @endif
                                                                <input type="text" class="form-control" id="ecart-{{ $ind->id_ind }}" value="{{ $item->ecart }}" readonly>
                                                                <input type="hidden" name="ecartType[{{ $ind->id_ind }}]" id="ecartType-{{ $ind->id_ind }}" value="{{ $item->ecartType }}">
                                                            </div>
                                                        </div>

                                                    </div>

                                                    @if ($item->ecartType == 'négatif')
                                                        <div class="row">
                                                            <div class="form-group col-6 mb-4">
                                                                <label class="fs-4" for="cause-{{ $ind->id_ind }}">Cause(s)</label>
                                                                <textarea name="cause[{{ $ind->id_ind }}]" id="cause-{{ $ind->id_ind }}" class="form-control" rows="3"></textarea>
                                                            </div>
                                                            <div class="form-group col-6 mb-4">
                                                                <label class="fs-4" for="action_corrective-{{ $ind->id_ind }}">Action(s) Corrective(s)</label>
                                                                <textarea name="action_corrective[{{ $ind->id_ind }}]" id="action_corrective-{{ $ind->id_ind }}" class="form-control" rows="3"></textarea>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="row">
                                                            <div class="form-group col-6 mb-4">
                                                                <label class="fs-4">Cause(s)</label>
                                                                <textarea readonly class="form-control bg-light" rows="3"></textarea>
                                                            </div>
                                                            <div class="form-group col-6 mb-4">
                                                                <label class="fs-4">Action(s) Corrective(s)</label>
                                                                <textarea readonly class="form-control bg-light" rows="3"></textarea>
                                                            </div>
                                                        </div>
                                                    @endif

                                                @endif
                                            @endforeach
                                        @endforeach

                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Ajouter</button>
                                        </div>
                                    </form>

                                    </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>









            <footer class="footer text-center text-muted" >
                Système de Planification
            </footer>
        </div>


    </div>
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
    {{-- <script src="{{asset('dist/js/pages/morris/morris-data.js')}}"></script> --}}


    {{-------------------------------------------------------------------------------------}}
    <script src="{{asset('assets/extra-libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/extra-libs/datatables.net-bs4/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('dist/js/pages/datatable/datatable-basic.init.js')}}"></script>

    {{-- <script src="{{asset('dist/js/bootstrap.bundle.min.js')}}"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

    <script src="{{asset('dist/js/bootstrap.min.js')}}"></script>

    <script>
    $(document).ready(function() {
    function fetchCauseAction() {
        var month = $('#month').val();
        $.ajax({
            url: '{{ route("directeur.fetchCauseAction") }}', // route to fetch data
            method: 'GET',
            data: { month: month },
            success: function(response) {
                // Clear existing textareas and input fields
                $('textarea[name^="cause"]').val('');
                $('textarea[name^="action_corrective"]').val('');
                $('input[name^="result"]').val('');
                $('input[name^="cible"]').val('');
                $('input[name^="ecart"]').val('');
                $('input[name^="ecartType"]').val('');

                // Populate textareas and input fields with fetched data
                $.each(response.data, function(index, value) {
                    $('#cause-' + value.id_ind).val(value.lib_cause);
                    $('#action_corrective-' + value.id_ind).val(value.lib_correct);
                    $('#result-' + value.id_ind).val(value.result);
                    $('#cible-' + value.id_ind).val(value.cible ? value.cible.cible : '');
                    $('#ecart-' + value.id_ind).val(value.ecart);
                    $('#ecartType-' + value.id_ind).val(value.ecartType);
                });
            }
        });
    }

    // Fetch data when the period is changed
    $('#month').on('change', function() {
        fetchCauseAction();
    });

    // Fetch data on page load
    fetchCauseAction();
});
</script>
</body>
</html>
