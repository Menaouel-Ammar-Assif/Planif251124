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

    <!-- This page css -->
    <link href="{{asset('dist/css/style.min.css')}}" rel="stylesheet">

    <link href="{{asset('assets/libs/morris.js/morris.css')}}" rel="stylesheet">

</head>

<body>
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->


    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full"  >
        <!-- ============================================================== -->

        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-lg custom-navbar-width" style="background-color: rgba(49, 148, 175, 0.556);max-height:5px;">

                <div class="navbar-header" data-logobg="skin5" >
                <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-lg-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>

                <!-- ============================================================== -->
                    <div class="navbar-brand justify-content-center">
                        <!-- Logo icon -->
                        <a class="d-flex align-items-center " href="{{ route('directeur.dashboard') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        </a>
                    </div>

                <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-lg-none waves-effect waves-light" href="javascript:void(0)"
                        data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i></a>
                </div>


                <div class="navbar-collapse collapse" id="navbarSupportedContent" style="border-bottom: transparent;">

                    <ul class="navbar-nav float-left me-auto ms-3 ps-1">
                        <!-- Notification -->
                        <li class="nav-item dropdown">

                            {{-- <li> --}}
                                <p class="nav-link pt-3 text-light fs-4" class="blockquote">
                                    <strong>Système de Planification</strong>
                                </p>
                            {{-- </li> --}}

                        </li>

                    </ul>

                    <ul class="navbar-nav float-left me-3 ms-auto ps-1">

                    </ul>

                    <ul class="navbar-nav float-end">

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <img src="{{asset('assets/images/users/user__.png')}}" alt="user" class="rounded-circle"
                                    width="40">
                                <span class="ms-2 d-none d-lg-inline-block"><span></span> <span
                                        class="text-dark">Directeur Général</span> <i data-feather="chevron-down"
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

                    </ul>
                </div>
            </nav>
        </header>

        <aside class="left-sidebar" data-sidebarbg="skin6" style="background-color:  rgba(49, 148, 175, 0.556)">

            <div class="scroll-sidebar" data-sidebarbg="skin6">

                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item font-weight-medium">
                            <a class="sidebar-link sidebar-link" href="{{ route('consult.dashboard') }}" aria-expanded="false"><i data-feather="home" class="feather-icon"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="list-divider"></li>

                        <li class="sidebar-item">
                            <a class="sidebar-link font-weight-medium" href="{{ route('consult.charts') }}" aria-expanded="false"><i data-feather="bar-chart-2" class="feather-icon"></i>
                                <span class="hide-menu">Graphiques</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link font-weight-medium" href="{{ route('consult.liaison') }}" aria-expanded="false"><i data-feather="list" class="feather-icon"></i>
                                <span class="hide-menu">Déclinaison-Structures</span>
                            </a>
                        </li>

                    </ul>
                </nav>

            </div>

        </aside>

        <div class="page-wrapper">

            <div class="container-fluid">

                    {{-- <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Déclinaison de concepts</h4>

                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="row">

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Etat d'avencement Total</h4>
                                    <div id="morris-line-chart"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Etat d'avencement DC et DR</h4>
                                    <ul class="list-inline text-center mt-5">
                                        <li class="list-inline-item">
                                            <h5><i class="fa fa-circle me-1 text-cyan"></i>DC</h5>
                                        </li>
                                        <li class="list-inline-item">
                                            <h5><i class="fa fa-circle me-1 text-info"></i>DR</h5>
                                        </li>
                                    </ul>
                                    <div id="extra-area-chart"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Etat d'avencement DC et DR</h4>
                                    <ul class="list-inline text-end">
                                        <li class="list-inline-item">
                                            <h5><i class="fa fa-circle me-1 text-info"></i>DC</h5>
                                        </li>
                                        <li class="list-inline-item">
                                            <h5><i class="fa fa-circle me-1 text-cyan"></i>DR</h5>
                                        </li>
                                    </ul>
                                    <div id="morris-area-chart"></div>
                                </div>
                            </div>
                        </div>

                    </div>









            </div>

            <footer class="footer text-center text-muted">
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
    <script src="{{asset('dist/js/pages/morris/morris-data.js')}}"></script>
    {{-------------------------------------------------------------------------------------}}
{{------------------------------------------DataTables-----------------------------------------------------}}
<script src="{{asset('assets/extra-libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/extra-libs/datatables.net-bs4/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('dist/js/pages/datatable/datatable-basic.init.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="{{asset('dist/js/bootstrap.min.js')}}"></script>
    <script>
        $(function () {
            $('[data-plugin="knob"]').knob();
        });

    </script>
    <script>
         $(document).ready(function() {
            $('#zero_liaison').DataTable();
        });
    </script>

<script>

        var data = [
            @foreach($Charts as $chart)
                { y: '{{ $chart->date }}', item1: {{ $chart->avncT }} },
            @endforeach
        ];

        var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        var line = new Morris.Line({
            element: 'morris-line-chart',
            resize: true,
            data: data,
            xkey: 'y',
            ykeys: ['item1'],
            labels: ['La valeur '],
            ymax: 100,
            gridLineColor: '#eef0f2',
            lineColors: ['#15aa00'],
            // #5f76e8
            lineWidth: 1,
            hideHover: 'auto',
            xLabels:  "month",
            xLabelAngle: 45,
            xLabelFormat: function(x) { var month = months[x.getMonth()]; return month; },
        });



        var data2 = [
            @foreach($Charts as $chart)
                { period: '{{ $chart->date }}', DC: {{ $chart->avncdc }}, DR: {{ $chart->avncdr }}},
            @endforeach
        ];

        Morris.Area({
        element: 'morris-area-chart',
        data: data2,
        xkey: 'period',
        ykeys: ['DC', 'DR'],
        labels: ['DC', 'DR'],
        pointSize: 3,
        ymax: 100,
        fillOpacity: 0,
        pointStrokeColors:['#5f76e8', '#01caf1'],
        behaveLikeLine: true,
        gridLineColor: '#e0e0e0',
        lineWidth: 3,
        hideHover: 'auto',
        lineColors: ['#5f76e8', '#01caf1'],
        resize: true,
        xLabels:  "month",
        xLabelAngle: 45,
        xLabelFormat: function(x) { var month = months[x.getMonth()]; return month; },
    });

    var data2 = [
            @foreach($Charts as $chart)
                { period: '{{ $chart->date }}', DC: {{ $chart->avncdc }}, DR: {{ $chart->avncdr }}},
            @endforeach
        ];

    Morris.Area({
        element: 'extra-area-chart',
        data: data2,
        lineColors: ['#01caf1', '#5f76e8'],
        xkey: 'period',
        ykeys: ['DC', 'DR'],
        labels: ['DC', 'DR'],
        pointSize: 2,
        ymax: 100,
        lineWidth: 0,
        resize:true,
        fillOpacity: 0.8,
        behaveLikeLine: true,
        gridLineColor: '#e0e0e0',
        hideHover: 'auto',
        xLabels:  "month",
        xLabelAngle: 45,
        xLabelFormat: function(x) { var month = months[x.getMonth()]; return month; },
    });

</script>
</body>
</html>
