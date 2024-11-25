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
    <link href="{{asset('assets/all.min.css')}}" rel="stylesheet">

    <link href="{{asset('assets/libs/morris.js/morris.css')}}" rel="stylesheet">
</head>
<style>
    .balls {
    width: 1em;
    display: flex;
    flex-flow: row nowrap;
    align-items: center;
    justify-content: space-between;
    }

    .balls div {
    width: 0.7em;
    height: 0.6em;
    border-radius: 50%;
    background-color: #fc2f70;
    transform: translateY(-70%);
    animation: wave 0.8s ease-in-out alternate infinite;
    }

    .balls div:nth-of-type(1) {
    animation-delay: -0.4s;
    }

    .balls div:nth-of-type(2) {
    animation-delay: -0.2s;
    }

    @keyframes wave {
    from {
        transform: translateY(-100%);
    }
    to {
        transform: translateY(80%);
    }
    }


    .animate-charcter
    {
        text-transform: uppercase;
        background-image: linear-gradient(
            -225deg,
            #231557 0%,
            #44107a 29%,
            #ff1361 67%,
            #fff800 100%
        );
        background-size: auto auto;
        background-clip: border-box;
        background-size: 200% auto;
        color: #fff;
        background-clip: text;
        text-fill-color: transparent;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: textclip 2s linear infinite;
        display: inline-block;
            font-size: 15px;
    }

    @keyframes textclip {
    to {
        background-position: 200% center;
    }
    }

    .sub-table {
    display: none;
    }

    .sub-table td input {
        width: 100%;
    }

    .animate-border{
        animation: wave 1.5s ease-in-out alternate infinite;
    }
    .animate-border h6{
        animation: colorr 1.5s ease-in-out alternate infinite;
    }

        @keyframes wave {
        from {
            background-color: rgb(255, 255, 255);
        }
        to {
            background-color: rgb(252, 217, 217);
        }}

        @keyframes colorr {
        from {
            color: rgb(253, 79, 79);
        }
        to {
            color: rgb(255, 255, 255);
        }

    }

    #atteinte {
        margin-left: 10px;
        border-radius: 15px;
        position: relative;
        width: 2em;
        height: 2em;
        border: 2px solid #ff05288c;
        overflow: hidden;
        animation: spin 3s ease infinite;
    }

    #atteinte::before {
        content: '';
        position: absolute;
        top: -3px;
        left: -3px;
        width: 2em;
        height: 2em;
        background-color: hsla(0, 100%, 72.2%, 0.63);
        transform-origin: center bottom;
        transform: scaleY(1);
        animation: fill 3s linear infinite;
    }

    @keyframes spin {
        50%,
        100% {
            transform: rotate(360deg);
        }
    }

    @keyframes fill {
        25%,
        50% {
            transform: scaleY(0);
    }
        100% {
            transform: scaleY(1);
        }
    }

    #atteinte2 {
    margin-left: 15px;
    display: flex;
    flex-flow: row nowrap;
    align-items: center;
    justify-content: space-between;
    width: 2em;
    }

    .atteinte {
    width: 0.3em;
    height: 0.9em;
    background-color: #ff000080;
    }

    .atteinte:nth-of-type(1) {
    animation: grow 1.5s -0.45s ease-in-out infinite;
    }

    .atteinte:nth-of-type(2) {
    animation: grow 1.5s -0.3s ease-in-out infinite;
    }

    .atteinte:nth-of-type(3) {
    animation: grow 1.5s -0.15s ease-in-out infinite;
    }

    .atteinte:nth-of-type(4) {
    animation: grow 1.5s ease-in-out infinite;
    }

    @keyframes grow {
    0%,
    100% {
        transform: scaleY(1);
    }

    50% {
        transform: scaleY(2);
    }
    }

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
                    <a class="nav-toggler waves-effect waves-light d-block d-lg-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <div class="navbar-brand justify-content-center">
                        <a class="d-flex align-items-center " href="{{ route('directeur.dashboard') }}">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        </a>
                    </div>
                    <a class="topbartoggler d-block d-lg-none waves-effect waves-light" href="javascript:void(0)"
                        data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i></a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent" style="border-bottom: transparent;">
                    <ul class="navbar-nav float-left me-auto ms-3 ps-1">
                        <li class="nav-item dropdown ms-3 mt-4">
                            <div class="card py-3 px-2 text-light rounded-pill" style="width: max-content; background-color: transparent; font-size: 18px; font-weight: bolder">
                               {{$dir}}
                            </div>
                        </li>
                    </ul>

                    <ul class="navbar-nav float-left me-3 ms-auto ps-1">
                    </ul>
                    <ul class="navbar-nav float-end">
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

        <aside class="left-sidebar" data-sidebarbg="skin6" style="background-color:  rgba(0, 76, 255, 0.56)">

            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <nav class="sidebar-nav">


                    <ul id="sidebarnav">
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('consult.dashboard') }}"
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

                        @if (auth()->user()->id_dir && auth()->user()->id_dir >= 1 && auth()->user()->id_dir <= 14)
                            <li class="sidebar-item">
                                <a class="sidebar-link font-weight-medium" href="{{ route('directeur.ActionsPrio') }}" aria-expanded="false">
                                    <i class="fa-solid fa-star pe-3"></i>
                                    <span>Actions Prioritaires</span>
                                </a>
                            </li>
                        @endif
                        <li class="list-divider"></li>

                        <li class="sidebar-item">
                            <a class="sidebar-link font-weight-medium" href="{{ route('directeur.proposition') }}" aria-expanded="false"><i data-feather="tag" class="feather-icon"></i>
                                @if (auth()->user()->id_dir && auth()->user()->id_dir >= 1 && auth()->user()->id_dir <= 14)
                                    <span class="hide-menu">Proposer Des Actions</span>
                                @else
                                    <span class="hide-menu">Actions Ajustées</span>
                                @endif
                            </a>
                        </li>





                        @if (auth()->user()->id_dir && auth()->user()->id_dir >= 1 && auth()->user()->id_dir <= 14)
                            <li class="list-divider"></li>
                            <li class="nav-small-cap"><span class="hide-menu font-weight-medium">C O P</span></li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('directeur.ActionsCop') }}" aria-expanded="false">
                                    <i class="fa solid fa-file-contract pe-3" ></i>
                                    <span>Actions COP</span>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->id_dir && auth()->user()->id_dir == '9')
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="{{ route('directeur.pageCalculate') }}"
                                    aria-expanded="false"><i class="fa-solid fa-calculator me-2 fa-lg"></i>
                                    <span class="font-weight-medium">Les calculs</span>
                                </a>
                            </li>
                        @else
                        @php
                            $found = false;
                        @endphp

                        @foreach ($NumDenom as $item)
                            @if (auth()->user()->id_dir == $item->id_dc)
                                <li class="sidebar-item">
                                    <a class="sidebar-link font-weight-medium" href="{{ route('directeur.copAdd') }}" aria-expanded="false">
                                        <i data-feather="file-plus" class="feather-icon"></i>
                                        <span class="hide-menu">COP</span>
                                    </a>
                                </li>
                                @php
                                    $found = true;
                                @endphp
                            @endif

                            @if ($found)
                                @break
                            @endif
                        @endforeach
                        @endif

                    </ul>



                </nav>

            </div>
        </aside>

        <div class="page-wrapper" style="background-color: rgb(245, 245, 245)">
            <div class="page-breadcrumb">
                <div class="row">
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="ribbon">C O P</div>
                                <div class="row">
                                    <div class="col-md-8 col-lg-3">
                                        <div class="card border-end">
                                            <div class="card-body border border-dark border-2">
                                                    <div class="d-flex align-items-center">
                                                        <div id="buttonWrapper" class="clickable">
                                                            <div class="d-inline-flex align-items-center">
                                                                <h2 class="text-dark mb-1 font-weight-medium" style="margin-left:50px;">
                                                                    {{$NbActCop}}
                                                                </h2>
                                                            </div>
                                                            <h6 class="font-weight-medium mb-0 w-100 text-dark" style="margin-left:50px;">Toutes les actions COP</h6>
                                                        </div>

                                                        <div class="ms-auto mt-md-3 mt-lg-0">
                                                            <span class="opacity-7 text-muted"><i data-feather="layers" class="text-dark"></i></span>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            <div class="card">
                                <h5 class="card-title mb-3">Objectifs Stratégiques</h5>
                                <div class="accordion" id="accordionExample">
                                    @foreach($objectifs as $obj)
                                        <div class="accordion-item mb-2">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#{{$obj->id_obj}}" aria-expanded="true" aria-controls="{{$obj->id_obj}}">
                                                    {{ $obj->lib_obj }}
                                                </button>
                                            </h2>
                                            <div id="{{$obj->id_obj}}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                                <div class="accordion-body details-content">
                                                    <table class="table border text-dark" id="zero_cop_{{$obj->id_obj}}">
                                                        <thead style="background-color: rgba(44, 44, 44, 0.74); color: #fff" class="text-center">
                                                            <tr>
                                                                <th>Sous Objectif</th>
                                                                <th>Action</th>
                                                                <th>Indicateur de Performance</th>
                                                                <th>Date début</th>
                                                                <th>Date fin</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($obj->sousObjectifs as $sousObj)
                                                                @foreach($sousObj->actionsCop as $actionsCop)
                                                                    @foreach($actionsCop->actions as $action)
                                                                        @if($actionsCop->id_act_cop == $action->id_cop && $action->direction && $action->direction->id_dir == auth()->user()->id_dir)
                                                                            <tr id="{{ $actionsCop->id_act}}" style="background-color: #f7f7f7">
                                                                                <td>{{ $sousObj->lib_sous_obj }}</td>
                                                                                <td>{{ $actionsCop->lib_act_cop }}</td>
                                                                                <td>   
                                                                                    @foreach($actionsCop->actCopInd as $aci)
                                                                                        <button type="button" class="" style="background-color: transparent; border: none; box-shadow: none;"
                                                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                                                            data-bs-custom-class="custom-tooltip"
                                                                                            data-bs-title="{{$aci->indicateur->formule}}.">
                                                                                            <span><a class="link-offset-2 link-underline">{{ $aci->indicateur->lib_ind }}<br></a></span>
                                                                                        </button>
                                                                                    @endforeach
                                                                                </td>
                                                                                <td>{{ date('d-m-Y', strtotime($actionsCop->dd)) }}</td>
                                                                                <td>{{ date('d-m-Y', strtotime($actionsCop->df)) }}</td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                @endforeach
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
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

{{------------------------------------------DataTables-----------------------------------------------------}}
<script src="{{asset('assets/extra-libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/extra-libs/datatables.net-bs4/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('dist/js/pages/datatable/datatable-basic.init.js')}}"></script>
    {{-------------------------------------------------------------------------------------}}





    <script>
        $(document).ready(function() {
        var obj = {!! json_encode($object) !!};
        var len = obj.length;

        $(function () {
            $('[data-bs-toggle="tooltip"]').tooltip();
        });

        // Function to create sub-table HTML for each row
        function format(infos) {
            var html = '<table class="table subtable">' +
                '<thead class="bg-info" style="color: #fff">' +
                '<tr>' +
                '<th scope="col">Ce qui a été fait</th>' +
                '<th scope="col">Ce qui reste à faire</th>' +
                '<th scope="col">Contraintes</th>' +
                '<th scope="col">Date</th>' +
                '<th scope="col" style="width:10%;">Etat</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>';

            infos.forEach(function(info) {
                var date = new Date(info.date);
                // Formatting the date to "d-m-Y" format
                var formattedDate = date.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: 'numeric' });

                html += '<tr style="background-color:#d7ddf8">' +
                    '<td scope="col">' + info.faite + '</td>' +
                    '<td scope="col">' + info.a_faire + '</td>' +
                    '<td scope="col">' + info.probleme + '</td>' +
                    '<td scope="col">' + formattedDate + '</td>' +
                    '<td scope="col">' +

                        '<div class="d-flex justify-content-center" style="flex-direction: column">' +
                                '<div class="fs-6 text-dark">' +info.etat.toFixed(0)+ '%</div>' +
                                '<div class="progress border border-success border-1" role="progressbar" aria-label="example" aria-valuenow="' +info.etat+ '" aria-valuemin="0" aria-valuemax="100">' +
                                    '<div class="progress-bar bg-success" style="width: ' + info.etat + '%"></div>' +
                                '</div>' +
                        '</div>' +




                    '</td>' +
                    '</tr>';
            });

            html += '</tbody>' + '</table>';
            return html;
        }

        for (var i = 1; i <= len; i++) {
            (function(index) {
                var dataTable = $('#zero_cop_' + index).DataTable();

                // Event listener to toggle child rows
                $('#zero_cop_' + index + ' tbody').on('click', 'tr', function() {
                    var tr = $(this);
                    var row = dataTable.row(tr);
                    var act = tr.attr('id');

                    if (row.child.isShown()) {
                        row.child.hide();
                        tr.removeClass('shown');
                    } else {
                        // Close any open rows
                        dataTable.rows().every(function() {
                            if (this.child.isShown()) {
                                this.child.hide();
                                $(this.node()).removeClass('shown');
                            }
                        });

                        $.ajax({
                            type: 'GET',
                            url: '{{ url("/directeur/ActionInfo") }}/' + act,
                            success: function(response) {
                                var subtableHtml = format(response.infos);
                                row.child(subtableHtml).show();
                                tr.addClass('shown');
                            },
                            error: function(xhr, status, error) {
                                console.error('Error fetching data:', error);
                            }
                        });
                    }
                });
                dataTable.on('draw.dt', function () {
                    $('[data-bs-toggle="tooltip"]').tooltip();
                });
            })(i);
        }
    });
    </script>


</body>

</html>
